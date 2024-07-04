<?php

namespace App\Exceptions;

use Exception;

class QoreIdError extends Exception
{
    public function render()
    {
        $notify[] = ['success', $this->getMessage()];
        return redirect()->back()->withNotify($notify);
    }
}
