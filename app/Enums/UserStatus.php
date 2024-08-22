<?php
namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum UserStatus: string implements HasLabel, HasColor
{
    case ACTIVE = 'active'; // The user can log in and access the system.
    case INACTIVE = 'inactive'; // The user cannot log in until their account is activated again.
    case SUSPENDED = 'suspended'; //The user is temporarily banned from accessing the system.
    case UNVERIFIED = 'unverified'; // The user’s account must be verified by the admin to access the system.
    case DELETED ='deleted'; // The account is deleted by the admin and cannot be recover again

    public function getLabel(): ?string
    {
        return match ($this)
        {
            self::ACTIVE => 'active',
            self::INACTIVE => 'inactive',
            self::SUSPENDED => 'suspended',
            self::UNVERIFIED => 'unverified',
            self::DELETED => 'deleted',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this)
        {
            self::ACTIVE => 'success',
            self::INACTIVE => 'warning',
            self::SUSPENDED => 'danger',
            self::UNVERIFIED => 'gray',
            self::DELETED => 'gray',
        };  
    }
}

