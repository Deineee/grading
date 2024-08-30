<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SemesterResource\Pages;
use App\Filament\Resources\SemesterResource\RelationManagers;
use App\Models\Semester;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;
use App\Models\User;

class SemesterResource extends Resource
{
    protected static ?string $model = Semester::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $navigationGroup = 'REGISTRAR';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)->schema([
                    TextInput::make('name')
                        ->required(),

                    TextInput::make('school_name') 
                        ->required(),

                    TextInput::make('school_id') 
                        ->required(),

                    DatePicker::make('start_date') 
                        ->native(false)
                        ->displayFormat('d/m/Y') 
                        ->required(),

                    DatePicker::make('end_date') 
                        ->native(false) 
                        ->displayFormat('d/m/Y') 
                        ->required(),

                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'active' => 'Active',
                            'inactive' => 'Inactive',
                            'completed' => 'Completed'
                        ])
                        ->visibleOn('edit')
                        ->native(false),
                    ]),    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn:: make('name')
                    ->label('NAME') 
                    -> searchable(),

                TextColumn:: make('school_name')
                    ->label('SCHOOL NAME') 
                    -> searchable(),

                TextColumn::make('school_year')
                    ->label('SCHOOL YEAR')
                    ->getStateUsing(function ($record) {
                        return $record->start_date->format('d/m/Y') . ' - ' . $record->end_date->format('d/m/Y');
                    }),

                TextColumn:: make('school_id') 
                    ->label('SCHOOL ID') 
                    -> searchable(),

                TextColumn::make('status') 
                    ->label('STATUS') 
                    ->badge()
                    ->colors([
                        'primary' => 'active',
                        'secondary' => 'inactive',
                        'success' => 'completed',
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => auth()->user()->isAdmin()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSemesters::route('/'),
            'create' => Pages\CreateSemester::route('/create'),
            'edit' => Pages\EditSemester::route('/{record}/edit'),
        ];
    }
}
