<?php

namespace Innerent\Contacts\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Contact
{
    public function make($contactable, array $data): Contact;

    public function update(array $data): Contact;

    public function get($contactable, $id): Contact;

    public function delete($contactable, $id, $force = false);

    public function toModel(): Model;

    public function toArray(): array;
}
