<?php

namespace App\Service;

use App\Entity\Note;

class NoteFormatter
{
    public function format(Note $note): string
    {
        return sprintf(
            "Title: %s\nCreated At: %s\n---\n%s",
            $note->getTitle(),
            $note->getCreatedAt()->format('YYYY-mm-dd'),
            $note->getContent()
        );
    }
}
