<?php

namespace Modules\Minisite\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\Block;
use App\BlockTypeFields;
use Modules\Minisite\Minisite;
use App\Mail\SendSiteEmail;

class MinisiteController extends Controller
{
    
    /**
     * The only minisite public view
     */
    public function public(Minisite $minisite){
        $user = Auth::user();
        if (!$minisite->visibleBy($user)) {
            abort(403, 'The site is not available.');
        }
        $returnBlocks = [];
        foreach($minisite->blocks as $block) {
            $content = json_decode($block->content);
            $mapped = [];
            foreach ($content as $field_key => $field_value) {
                $fieldDefinition = BlockTypeFields::where(['id' => (int) $field_key])->first();
                //@todo when less asleep: make into a transformer setup of sorts
                $field_value = $this->transform($block, $fieldDefinition, $field_value, $content);
                $mapped[$fieldDefinition->name] = $field_value;
            }
            // @todo not loving this hack... it's almost rude. Refactor when doing tranformers
            if ($block->type === 'RSS Feed' && $mapped['Limit'] && $mapped['Url'] && $mapped['Url']['item']) {
                $mapped['Url']['item'] = array_slice($mapped['Url']['item'], 0, (int) $mapped['Limit']);
            }
            $block->content = $mapped;
            if ($block->visibleBy($user)) {
                $returnBlocks[] = $block;
            }
        }
        $minisite->blocks = $returnBlocks;
        return view('minisite::public', ['minisite' => $minisite]);
    }

    public function email(Minisite $minisite, Block $block, Request $request)
    {
        $errors = null;
        $success = null;
        $content = json_decode($block->content);
        $email = null;
        foreach ($content as $field_key => $field_value) {
            $fieldDefinition = BlockTypeFields::where(['id' => (int) $field_key])->first();
            if ($fieldDefinition->name === 'Recipient') {
                $email = $field_value;
            }        
        }
        Mail::to($email)->send(new SendSiteEmail($block, $request->input('email'), $request->input('message')));
        if(count(Mail::failures()) > 0){
            $errors = 'Failed to send password reset email, please try again.';
        } else {
            $success = 'Sucessfully sent email.';
        }
        return redirect()->route(
            'minisitePublic',
            ['minisite' => $minisite] )->with( ['success' => $success, 'errors'=> $errors]
        );
    }
    /**
     * Block $block
     * BlockTypeFields $fieldDefinition
     * $field_value: the value assigned by the user in the administration panel for this block field (from the content field)
     * $full_definition: the full content object (assigned by the user in the administration panel)
     */
    private function transform(Block $block, BlockTypeFields $fieldDefinition, $field_value, $full_definition) {
        if ($block->type === 'Featured Youtube Video' && $fieldDefinition->name === 'Url') {
            preg_match('/http(?:s?):\/\/(?:www\.)?youtu(?:be\.com\/watch\?v=|\.be\/)([\w\-\_]*)(&(amp;)?‌​[\w\?‌​=]*)?/', $field_value, $youtubeId);
            // @todo: do this in the youtube video creation to validate that it's in fact a youtube url? 
            $field_value = isset($youtubeId[1]) ? $youtubeId[1] : $field_value;
            return $field_value;
        }
        if ($block->type === 'RSS Feed' && $fieldDefinition->name === 'Url') {
            try {
                $feed = \App\Helpers\RSSReader::load($field_value);            
                return $feed ? $feed->toArray() : null;
            } catch (\Exception $e) {
                return null;
            }
            
        }
        return $field_value;
    }

}
