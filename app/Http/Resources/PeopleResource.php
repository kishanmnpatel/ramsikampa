<?php

namespace App\Http\Resources;

use App\Models\Person;
use Illuminate\Http\Resources\Json\JsonResource;

class PeopleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $relations = null;
        if ($this->relation == Person::SELF) {
            $relations = 'self';
        }elseif($this->relation == Person::FATHER) {
            $relations = 'father';
        }elseif($this->relation == Person::HUSBUND) {
            $relations = 'husbund';
        }elseif($this->relation == Person::WIFE) {
            $relations = 'wife';
        }
        
        return [
            'id' => $this->id,
            "parent_id" => $this->parent_id,
            'name' => $this->name,
            'mobile' => $this->mobile,
            'surname_in_gujarati' => $this->surname->gujarati_word,
            'surname_in_english' => $this->surname->english_word,
            'gender' => $this->gender,
            'is_married' => $this->is_married,
            'is_daughter' => $this->is_daughter,
            'is_died' => $this->is_died,
            'relation_to_parent' => $relations,
            'address' => $this->address,
        ];
    }
}
