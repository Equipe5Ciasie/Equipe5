<?php

namespace trivial\controllers;

/**
 * Class EXEMPLE
 */
class EXEMPLEController {

    protected $view;

    /**
	 * Constructor of the class EXEMPLE
	 * @param view
	 */
    public function __construct(twig $view) {
        $this->view = $view;
    }

    /**
     * Method which rends the board of a game
     * @param request
     * @param response
     * @param args
     */
    public function renderEXEMPLE($request, $response, $args) {
        return $this->view->render($response, 'EXEMPLE.html.twig', [
            'EXEMPLE' => $EXEMPLE
        ]);
    }

}