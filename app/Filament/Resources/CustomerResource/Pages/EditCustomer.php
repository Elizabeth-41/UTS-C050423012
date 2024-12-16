<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    public function getRedirectUrl(): string
    {
        return $this->resource::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Edit Customer';
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label('Name')
                ->required()
                ->maxLength(100),

            Forms\Components\TextInput::make('phone')
                ->label('Phone')
                ->required()
                ->maxLength(15),

            Forms\Components\Textarea::make('address')
                ->label('Address')
                ->required(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Anda bisa menambahkan logika untuk memproses data di sini, jika diperlukan
        return $data;
    }
}
