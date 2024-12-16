<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms;

class ViewCustomer extends ViewRecord
{
    protected static string $resource = CustomerResource::class;

    public function getRedirectUrl(): string
    {
        return $this->resource::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'View Customer';
    }

    // Ubah metode ini untuk mengembalikan View
    public function getHeader(): ?\Illuminate\Contracts\View\View
    {
        return view('filament.resources.customer-resource.pages.view-customer-header', [
            'title' => $this->record->name,
            'description' => 'Details for ' . $this->record->name,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label('Name')
                ->required()
                ->disabled(), // Nonaktifkan agar tidak bisa diedit

            Forms\Components\TextInput::make('phone')
                ->label('Phone')
                ->required()
                ->disabled(), // Nonaktifkan agar tidak bisa diedit

            Forms\Components\Textarea::make('address')
                ->label('Address')
                ->required()
                ->disabled(), // Nonaktifkan agar tidak bisa diedit
        ];
    }
}
