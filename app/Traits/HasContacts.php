<?php

namespace App\Traits;

use App\Models\Contact;

trait HasContacts
{
    public function contacts(){
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function createContact($name, $phone){
        return $this->contacts()->create([
            'name' => $name,
            'phone' => $phone
        ]);
    }

    public function updateContact($id, $name, $phone){
        $contact = $this->contacts()->findOrFail($id);
        $contact->update([
            'name' => $name,
            'phone' => $phone,
        ]);
        return $contact;
    }
 
    public function deleteContact($id){
        $contact = $this->contacts()->findOrFail($id);
        $contact->delete();
        return $contact;
    }

    public function getContact($id){
        return $this->contacts()->findOrFail($id);
    }

    public function getContacts(){
        return $this->contacts()->get();
    }
}