<?php
/**
 * Created by PhpStorm.
 * User: jihen
 * Date: 22/02/17
 * Time: 09:18
 */

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends Controller
{
    /**
     * @Route("/to", name="todo_list")
     */
    public function listAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('todos/index.html.twig');
    }
}