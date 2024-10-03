<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Shop\Product;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CategoryList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Category::query())->headerActions([
                CreateAction::make('new')->label('New Category')->icon('heroicon-o-plus')->form([
                    TextInput::make('name')->required(),
                    Toggle::make('is_visible')->label('Visible')
                ])->modalWidth('xl')->modalHeading('Create Category')->createAnother(false)
            ])
            ->columns([
                TextColumn::make('name')->searchable()->label('NAME')->formatStateUsing(
                    fn($record) => strtoupper($record->name)
                ),
                TextColumn::make('is_visible')->label('STATUS')->badge()->formatStateUsing(
                    fn($record) => $record->is_visible ? 'VISIBLE' : 'HIDDEN'
                )->color(fn (string $state): string => match ($state) {
                    '0' => 'gray',
                    '1' => 'success',
                })
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')->color('success')->form([
                    TextInput::make('name')->required(),
                    Toggle::make('is_visible')->label('Visible')
                ])->modalWidth('xl')->modalHeading('Edit Category'),
                // DeleteAction::make('delete')
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No category yet!')->emptyStateDescription('Once you write your first category, it will appear here.');
    }

    public function render()
    {
        return view('livewire.admin.category-list');
    }
}
