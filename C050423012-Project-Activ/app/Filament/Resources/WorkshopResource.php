<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkshopResource\Pages;
use App\Models\Workshop;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\BooleanColumn;

class WorkshopResource extends Resource
{
    protected static ?string $model = Workshop::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('address')
                            ->rows(3)
                            ->required()
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('thumbnail')
                            ->image()
                            ->required(),

                        Forms\Components\FileUpload::make('venue_thumbnail')
                            ->image()
                            ->required(),

                        Forms\Components\FileUpload::make('bg_map')
                            ->image()
                            ->required(),

                                    Forms\Components\Repeater::make('benefits')
                                    ->relationship('benefits')
                                    ->schema([
                                    Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                            // Menambahkan Fieldset untuk Additional
                            Fieldset::make('Additional')
                            ->schema([
                            Forms\Components\Textarea::make('about')
                            ->required()
                            ->maxLength(500),

                            Forms\Components\TextInput::make('price')
                                ->required()
                                ->numeric()
                                ->rules('min:0')
                                ->placeholder('IDR'),

                                Forms\Components\Select::make('is_open')
                                ->label('Is Open')
                                ->options([
                                    1 => 'Open',
                                    0 => 'Closed',
                                ])
                                ->required(),

                                // Menambahkan field Has Started
                                Forms\Components\Select::make('has_started')
                                    ->label('Has Started')
                                    ->options([
                                        1 => 'Yes',
                                        0 => 'No',
                                    ])
                                    ->required(),

                                // Menambahkan field untuk Category
                                Forms\Components\Select::make('category_id')
                                    ->label('Category')
                                    ->relationship('category', 'name') // Pastikan relasi ada di model
                                    ->required(),

                                // Menambahkan field untuk Instructor
                                Forms\Components\Select::make('workshop_instructor_id')
                                    ->label('Instructor')
                                    ->relationship('instructor', 'name') // Pastikan relasi ada di model
                                    ->required(),

                                // Menambahkan field untuk Started At
                                Forms\Components\DatePicker::make('started_at')
                                    ->label('Started At')
                                    ->format('m/d/y') 
                                    ->required(),

                                // Menambahkan field untuk Time At
                                Forms\Components\TimePicker::make('time_at')
                                    ->label('Time At')
                                    ->format('H:i') // Format waktu
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('instructor.name'),
                BooleanColumn::make('has_started')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->label('Started'),
                Tables\Columns\TextColumn::make('participants_count')
                    ->label('Participants')
                    ->counts('participants'),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),
                SelectFilter::make('workshop_instructor_id')
                    ->label('Workshop Instructor')
                    ->relationship('instructor', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkshops::route('/'),
            'create' => Pages\CreateWorkshop::route('/create'),
            'edit' => Pages\EditWorkshop::route('/{record}/edit'),
        ];
    }
}