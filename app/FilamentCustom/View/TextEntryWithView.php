<?php

namespace App\FilamentCustom\View;

use Filament\Infolists\Components\TextEntry;

class TextEntryWithView extends TextEntry {
    /**
     * Whether to hide the field if state is empty
     */
    protected bool $removeIfEmpty = false;

    /**
     * Whether to use fontawesome icons instead of filament icons
     */
    protected bool $setFontawesome = false;

    protected function setUp(): void {
        parent::setUp();

        $this->view('components.custom.text-view-entry');

        // Auto-hide the entry if it's empty and removeIfEmpty is true
        $this->hidden(function () {
            if (!$this->removeIfEmpty) {
                return false;
            }

            $state = $this->getState();

            // Convert to string if possible
            if (is_object($state) && method_exists($state, '__toString')) {
                $state = (string)$state;
            }

            // Clean HTML and check if blank
            return blank(strip_tags($state));
        });
    }

    /**
     * Control whether to hide the entry if it's empty
     */
    public function removeIfEmpty(bool $condition = true): static {
        $this->removeIfEmpty = $condition;

        return $this;
    }

    /**
     * Enable fontawesome rendering instead of filament icons
     */
    public function setFontawesome(bool $condition = true): static {
        $this->setFontawesome = $condition;

        return $this;
    }

    public function getViewData(): array {
        return array_merge(
            parent::getViewData(),
            [
                'state' => $this->getState(),
                'getLabel' => fn() => $this->getLabel(),
                'getIcon' => fn($state) => $this->getIcon($state),
                'setFontawesome' => $this->setFontawesome,
            ],
        );
    }
}
