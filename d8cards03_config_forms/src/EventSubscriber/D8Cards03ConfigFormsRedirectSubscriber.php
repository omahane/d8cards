<?php
namespace Drupal\d8cards03_config_forms\EventSubscriber;

use Drupal\Core\Routing\LocalRedirectResponse;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent; // update from deprecated GetResponseEvent
use Symfony\Component\HttpKernel\KernelEvents;
/**
 * Subscribes to the Kernel Request event and redirect to the homepage
 * when the user has the non_grata role.
 */
class D8Cards03ConfigFormsRedirectSubscriber implements EventSubscriberInterface {
    /**
     * @var \Drupal\Core\Session\AccountProxyInterface
     */
    // Stores current user as class property to use later.
    protected $currentUser;
    /**
     * The current route match.
     *
     * @var \Drupal\Core\Routing\RouteMatchInterface
     */
    protected $currentRouteMatch;
    /**
     * HelloWorldRedirectSubscriber constructor.
     *
     * @param \Drupal\Core\Session\AccountProxyInterface $currentUser
     *   The current user.
     * @param \Drupal\Core\Routing\RouteMatchInterface $currentRouteMatch
     *   The current route match.
     */
    public function __construct(AccountProxyInterface $currentUser, RouteMatchInterface $currentRouteMatch) {
        $this->currentUser = $currentUser;
        $this->currentRouteMatch = $currentRouteMatch;

    }
    /**
     * {@inheritdoc}
     */
    // Returns a mapping between event names and class methods to be called if the event is intercepted.
    public static function getSubscribedEvents()
    {
        // Returns the callback method name in array
        // with second value representing the priority of the callback
        // The higher the number, the higher the priority, running earlier in the process.
        $events[KernelEvents::REQUEST][] = ['onRequest', 0];
        return $events;
    }
    /**
     * Handler for the kernel request event.
     *
     * @param \Symfony\Component\HttpKernel\Event\RequestEvent $event
     */
    public function onRequest(RequestEvent $event) {
        $route_name = $this->currentRouteMatch->getRouteName();
        if ($route_name != 'd8cards03_config_forms.hello') {
            return;
        }

        $roles = $this->currentUser->getRoles();
        if (in_array('non_grata', $roles)) {
            $url = Url::fromUri('internal:/');
            $event->setResponse(new LocalRedirectResponse($url->toString()));
        }
    }
}
