<?php namespace App\Controllers\TodoListController;

final class ResponseMessageConstants
{
    const UNKNOWN_ERROR_ID      = 1001;
    const UNKNOWN_ERROR_MESSAGE = 'Unknown error.';

    const VALIDATION_ERROR_ID      = 1002;
    const VALIDATION_ERROR_MESSAGE = 'Validation error.';

    const TODO_ITEM_ERROR_ID      = 1003;
    const TODO_ITEM_ERROR_MESSAGE = 'Todo item not found.';
}
