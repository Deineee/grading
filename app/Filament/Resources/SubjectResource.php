<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectResource\Pages;
use App\Filament\Resources\SubjectResource\RelationManagers;
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\MultiSelect;
use Filament\Tables\Columns\TextColumn;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'STUDENT SECTION';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)->schema([
                    TextInput::make('subject_name')
                        ->label('Subject Name')
                        ->unique(ignoreRecord: true)
                        ->required(),
                    
                    TextInput::make('subject_code')
                        ->label('Subject Code')
                        ->unique(ignoreRecord: true)
                        ->required(),

                    Select::make('user_id')
                        ->label('Teacher')
                        ->required() 
                        ->native(false)
                        ->relationship('user', 'name', function ($query) {
                            $query->teachers();
                        }),

                    TextInput::make('subject_description') 
                        ->label('Subject Description'),
                    
                    MultiSelect::make('prerequisite_subjects')
                        ->label('Prerequisite Subjects')
                        ->relationship('prerequisites', 'subject_name')
                        ->native(false)
                        ->nullable(),

                    TextInput::make('credits') 
                        ->required() 
                        ->numeric()  
                        ->maxValue(10) 
                        ->label('Credits'),

                    Select::make('program_id') 
                        -> label('Program')
                        ->required() 
                        ->relationship('program', 'program_name') 
                        ->native(false)
                    ]),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subject_name')
                    ->label('Subject Name'),
                
                TextColumn::make('user.full_name')
                    ->label('Teacher')
                    ->searchable(),

                TextColumn::make('subject_code')
                    ->label('Subject Code')
                    ->sortable(),

                TextColumn::make('credits')
                    ->label('Credits')
                    ->sortable(),

                TextColumn::make('prerequisites')
                    ->label('Prerequisites')
                    ->getStateUsing(function ($record) {
                        // Fetch the prerequisite subjects related to the current subject
                        return $record->prerequisites->pluck('subject_name')->join(', ');
                    }),

                TextColumn::make('program.program_name')
                    ->label('Program'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'edit' => Pages\EditSubject::route('/{record}/edit'),
        ];
    }
}
