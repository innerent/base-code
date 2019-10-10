<?php

namespace Innerent\Contacts\Repositories;

use Illuminate\Database\Eloquent\Model;
use Innerent\Contacts\Contracts\Contact as ContactInterface;
use Innerent\Contacts\Models\Address;
use Innerent\Contacts\Models\Contact;
use Innerent\Contacts\Models\Email;
use Innerent\Contacts\Models\Phone;

class ContactRepository implements ContactInterface
{
    protected $contact;

    public function make($contactable, $data): ContactInterface
    {
        $this->contact = $contactable->contacts()->create([
            'name' => $data['name'],
            'type' => $data['type'],
        ]);

        return $this;
    }

    public function update($data): ContactInterface
    {
        $this->contact->update(['name' => $data['name']]);

        return $this;
    }

    public function find($contactable, $id)
    {
        $this->contact = $contactable->contacts()->find($id);

        if (! $this->contact instanceof Contact) {
            abort(404);
        }

        return $this;
    }

    public function get($contactable, $id): ContactInterface
    {
        $this->contact = $contactable->contacts()->find($id);

        if (!$this->contact) {
            abort(404);
        }

        $this->contact = $this->contact->load('emails', 'addresses', 'phones');

        return $this;
    }

    public function delete($contactable, $id, $force = false)
    {
        $this->get($contactable, $id)->toModel()->delete();

        return true;
    }

    public function sync($data)
    {
        $emails = collect($data['emails'])->where('id', '!=', null);
        $this->contact->emails()->whereNotIn('id', $emails->pluck('id')->toArray())->delete();

        $phones = collect($data['phones'])->where('id', '!=', null);
        $this->contact->phones()->whereNotIn('id', $phones->pluck('id')->toArray())->delete();

        $addresses = collect($data['addresses'])->where('id', '!=', null);
        $this->contact->addresses()->whereNotIn('id', $addresses->pluck('id')->toArray())->delete();

        return $this;
    }

    public function toModel(): Model
    {
        return $this->contact->load('emails', 'phones', 'addresses');
    }

    public function toArray(): array
    {
        return $this->toModel()->toArray();
    }

    public function email(Email $email)
    {
        $this->contact->emails()->updateOrCreate(
            ['id' => $email->id],
            $email->toArray()
        );

        return $this;
    }

    public function address(Address $address)
    {
        $this->contact->addresses()->updateOrCreate(
            ['id' => $address->id],
            $address->toArray()
        );

        return $this;
    }

    public function phone(Phone $phone)
    {
        $this->contact->phones()->updateOrCreate(
            ['id' => $phone->id],
            $phone->toArray()
        );

        return $this;
    }
}
