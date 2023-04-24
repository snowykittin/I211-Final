<?php
// Exception to be thrown when a non-admin visits an admin page; or the page of an account they don't have access to
class UnauthorizedAccessException extends Exception
{

}