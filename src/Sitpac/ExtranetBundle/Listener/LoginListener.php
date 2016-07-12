<?php


namespace Sitpac\ExtranetBundle\Listener;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginListener
{
	private $contexto, $router, $estado = null, $session;
	public function __construct(SecurityContext $context, Router $router, Session $session )
	{
		$this->contexto = $context;
		$this->router = $router;
		$this->session = $session;
	}
	public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
	{
		if($this->contexto->isGranted('ROLE_PROVEEDOR')) {
			$token = $event->getAuthenticationToken();
			$this->estado = $token->getUser()->getEstado();
		}
	}
	public function onKernelResponse(FilterResponseEvent $event)
	{	
		if ($this->estado == 'Aprobado') {
			if($this->contexto->isGranted('ROLE_PROVEEDOR')) {
			$portadap = $this->router->generate('portadap');
			
			}
			$event->setResponse(new RedirectResponse($portadap));
			$event->stopPropagation();
		}
		else if ($this->estado == 'Solicitud registro') {
			if($this->contexto->isGranted('ROLE_PROVEEDOR')) {	
				
				$this->session->setFlash('info', 'Su Solicitud de regitro se encuentra en estudio.');
				$portada = $this->router->generate('proveedor_logout');
			}
			$event->setResponse(new RedirectResponse($portada));
			$event->stopPropagation();
			
		}

	}
}