<?php

namespace Innerent\Contact\Services;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Innerent\Contacts\Models\Address;
use Innerent\Contacts\Models\Email;
use Innerent\Contacts\Models\Phone;
use Innerent\Contacts\Repositories\ContactRepository;

class ContactService
{
    protected $repo;

    public function __construct(ContactRepository $repo)
    {
        $this->repo = $repo;
    }

    public function make($contactable, $data)
    {
        DB::beginTransaction();

        $contact = $this->repo->make($contactable, $data);

        foreach ($data['emails'] as $email) {
            $contact->email(new Email($email));
        }

        foreach ($data['addresses'] as $address) {
            $contact->address(new Address($address));
        }

        foreach ($data['phones'] as $phone) {
            $contact->phone(new Phone($phone));
        }

        DB::commit();

        return $contact->toModel();
    }

    public function update($contactable, $id, $data)
    {
        DB::beginTransaction();

        $name = $data['name'] ?? null;
        $type = $data['name'] ?? null;

        $contact = $this->repo->find($contactable, $id);

        $contact->update(['name' => $name, 'type' => $type]);

        $contact->sync($data);

        foreach ($data['emails'] as $email) {
            $contact->email(new Email($email));
        }

        foreach ($data['addresses'] as $address) {
            $contact->address(new Address($address));
        }

        foreach ($data['phones'] as $phone) {
            $contact->phone(new Phone($phone));
        }

        DB::commit();

        return $contact->toModel();
    }

    public function get($contactable, $id)
    {
        return $this->repo->get($contactable, $id)->toModel();
    }

    public function delete($contactable, $id)
    {
        return $this->repo->delete($contactable, $id);
    }

    public function instantiate($type, $id)
    {
        $contactable = new Relation::$morphMap[$type]();

        if (in_array(GeneratesUuid::class, class_uses($contactable))) {
            $contactable = $contactable->whereUuid($id)->get()->first();
        } else {
            $contactable = $contactable->find($id);
        }

        if (!$contactable) {
            abort(404);
        }

        return $contactable;
    }
}
