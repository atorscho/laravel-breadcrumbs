<?php

namespace spec\Atorscho\Crumbs;

use Illuminate\Config\Repository as Config;
use Illuminate\Routing\UrlGenerator;
use Mockery;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CrumbsItemSpec extends ObjectBehavior
{
    /**
     * @var \Mockery\MockInterface
     */
    protected $urlMock;

    /**
     * @var \Mockery\MockInterface
     */
    protected $configMock;

    public function let()
    {
        $this->urlMock    = Mockery::mock(UrlGenerator::class);
        $this->configMock = Mockery::mock(Config::class);

        $this->beConstructedWith('/home', 'Home Page', $this->urlMock, $this->configMock);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Atorscho\Crumbs\CrumbsItem');
    }

    public function it_returns_item_url()
    {
        $this->url->shouldReturn('/home');
    }

    public function it_returns_item_title()
    {
        $this->title->shouldReturn('Home Page');
    }

    public function it_detects_active_item_and_returns_true()
    {
        $this->urlMock->shouldReceive('current')->once()->andReturn('/home');

        $this->isActive()->shouldReturn(true);
    }

    public function it_outputs_active_class_attribute_when_on_current_crumbs_item()
    {
        $this->configMock->shouldReceive('get')->once()->andReturn('active');
        $this->urlMock->shouldReceive('current')->once()->andReturn('/home');

        $this->active()->shouldReturn('class="active"');
    }

    public function it_outputs_active_class_when_on_current_crumbs_item_and_argument_to_false()
    {
        $this->configMock->shouldReceive('get')->once()->andReturn('active');
        $this->urlMock->shouldReceive('current')->once()->andReturn('/home');

        $this->active(false)->shouldReturn('active');
    }

    public function it_throws_an_exception_when_called_to_inexisting_property()
    {
        $this->shouldThrow(\Atorscho\Crumbs\Exceptions\PropertyNotFoundException::class)->during('__get', ['someProperty']);
    }
}
