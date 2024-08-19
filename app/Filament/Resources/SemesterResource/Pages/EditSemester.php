<?php

namespace App\Filament\Resources\SemesterResource\Pages;

use App\Filament\Resources\SemesterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSemester extends EditRecord
{
    protected static string $resource = SemesterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function saveRecord(array $data): void
    {
        // Use valid status values
        $data['status'] = $data['status'] ? 'active' : 'inactive'; // Or adjust as needed

        parent::saveRecord($data);
    }

}
