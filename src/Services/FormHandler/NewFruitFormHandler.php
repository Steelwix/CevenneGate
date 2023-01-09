<?php

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TaskFormHandler
{
    public function handle(FormInterface $form, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        // use the data to populate the form and validate it
        $form->submit($data);

        if ($form->isValid()) {
            // perform some action (e.g. save the task to the database)
            // and return a response
            return new JsonResponse(['success' => true]);
        } else {
            // return an error response
            return new JsonResponse(['success' => false, 'errors' => $form->getErrors()], 400);
        }
    }
}
