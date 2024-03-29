<?php

namespace App\Filament\Resources\MusicResource\Pages;

use App\Filament\Resources\MusicResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Music;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Select;

class EditMusic extends EditRecord
{
    
    
    protected static string $resource = MusicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    

// protected function getSteps(): array
// {
//     return [
//         Step::make('Tags')
//             ->description('Add Track Details')
//             ->schema([
//                 TextInput::make('artist')->required(),
//                 TextInput::make('title')->required(),
//             ]),
            
//             Step::make('Genre')
//             ->description('Add Genre and Price')
//             ->schema([
//                 Select::make('amount')->label('price')
//                     ->options([
//                         '2' => 'R2',
//                         '5' => 'R5',
//                         '8' => 'R8',
//                         '10' => 'R10',
//                         '12' => 'R12',
//                         '15' => 'R15',
//                         '20' => 'R20',
//                     ]),

              
//             ]),
//         Step::make('Description')
//             ->description('Add Short Note')
//             ->schema([
//                 MarkdownEditor::make('description')
//                     ->columnSpan('full'),
//             ]),
        
//     ];
// }

}
