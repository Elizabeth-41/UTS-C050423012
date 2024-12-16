<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    public function getRedirectUrl(): string
    {
        return static::$resource::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Create Product';
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label('Name')
                ->required()
                ->maxLength(100),

            Forms\Components\Textarea::make('description')
                ->label('Description')
                ->required(),

            Forms\Components\TextInput::make('price')
                ->label('Price')
                ->required()
                ->numeric(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Add any custom logic to process data before saving if needed
        return $data;
    }
}
