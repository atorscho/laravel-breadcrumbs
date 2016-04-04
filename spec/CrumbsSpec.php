<?php

namespace spec\Atorscho\Crumbs;

use Illuminate\Config\Repository as Config;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Translation\Translator;
use Mockery;
use \PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CrumbsSpec extends ObjectBehavior
{
    /**
     * @var \Mockery\MockInterface
     */
    protected $requestMock;

    /**
     * @var \Mockery\MockInterface
     */
    protected $routeMock;

    /**
     * @var \Mockery\MockInterface
     */
    protected $urlMock;

    /**
     * @var \Mockery\MockInterface
     */
    protected $configMock;

    /**
     * @var \Mockery\MockInterface
     */
    protected $translatorMock;

    public function let()
    {
        $this->requestMock    = Mockery::mock(Request::class);
        $this->routeMock      = Mockery::mock(Router::class);
        $this->urlMock        = Mockery::mock(UrlGenerator::class);
        $this->configMock     = Mockery::mock(Config::class);
        $this->translatorMock = Mockery::mock(Translator::class);

        $this->beConstructedWith($this->requestMock, $this->routeMock, $this->urlMock, $this->configMock, $this->translatorMock);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Atorscho\Crumbs\Crumbs');
    }

    public function it_adds_an_item_to_the_breadcrumbs_array()
    {
        $this->routeMock->shouldReceive('has')->once()->andReturn(false);
        $this->urlMock->shouldReceive('to')->once()->andReturn('http://example.com/articles');
        $this->configMock->shouldReceive('get')->once()->andReturn(false);
        $this->configMock->shouldReceive('get')->twice()->andReturn(true);
        $this->requestMock->shouldReceive('is')->once()->andReturn(false);
        $this->requestMock->shouldReceive('is')->once()->andReturn(true);

        $this->add('/articles', 'All Articles');
        $this->getCrumbs()[0]->shouldBeAnInstanceOf(\Atorscho\Crumbs\CrumbsItem::class);
    }

    public function it_adds_current_page_by_only_specifying_its_title()
    {
        $this->urlMock->shouldReceive('current')->once()->andReturn('http://example.com/articles');
        $this->routeMock->shouldReceive('has')->once()->andReturn(false);
        $this->urlMock->shouldReceive('to')->once()->andReturn('http://example.com/articles');
        $this->configMock->shouldReceive('get')->once()->andReturn(false);
        $this->configMock->shouldReceive('get')->twice()->andReturn(true);
        $this->requestMock->shouldReceive('is')->once()->andReturn(false);
        $this->requestMock->shouldReceive('is')->once()->andReturn(true);

        $this->addCurrent('All Articles');
        $this->getCrumbs()[1]->title->shouldBeEqualTo('All Articles');
    }
}
