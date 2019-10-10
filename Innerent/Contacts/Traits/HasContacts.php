<?php

namespace Innerent\Contacts\Traits;

use Innerent\Contacts\Models\Contact;

trait HasContacts
{
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }
}
