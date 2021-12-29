<?php

namespace Filament\Resources\Pages\Concerns;

use Filament\Pages\Actions\SelectAction;

trait HasActiveFormLocaleSelect
{
    public $activeFormLocale = null;

    protected function getActiveFormLocaleSelectAction(): SelectAction
    {
        return SelectAction::make('activeFormLocale')
            ->label(__('filament-spatie-laravel-translatable-plugin::actions.active_form_locale.label'))
            ->options(
                collect(static::getResource()::getTranslatableLocales())
                    ->mapWithKeys(function (string $locale): array {
                        return [$locale => $locale];
                    })
                    ->toArray(),
            );
    }

    protected function getRecordTitle(): ?string
    {
        if ($this->activeFormLocale) {
            $this->record->setLocale($this->activeFormLocale);
        }

        return parent::getRecordTitle();
    }
}
