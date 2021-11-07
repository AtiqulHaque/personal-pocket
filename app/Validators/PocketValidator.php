<?php
namespace App\Validators;

class PocketValidator extends AbstractLaravelValidator
{


    public function setCreatePocketRules()
    {
        $this->rules = array(
            'title' => 'required|max:200'
        );
    }


    public function setCreatePocketContentRules()
    {
        $this->rules = array(
            'pocket_id' => 'required|max:15',
            'site_url' => 'required|url',
            'hash' => 'sometimes|required'
        );
    }


    public function setHashTagContentRules()
    {
        $this->rules = array(
            'hash' => 'required'
        );
    }


    public function setDeleteContentRules()
    {
        $this->rules = array(
            'site_url' => 'required|url',
        );
    }
}
