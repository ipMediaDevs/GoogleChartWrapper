<?php namespace spec\IpMedia;

use IpMedia\GoogleChartWrapper;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class GoogleChartWrapperSpec
 *
 * @mix GoogleChartWrapper
 */
class GoogleChartWrapperSpec extends ObjectBehavior {

	function it_is_initializable()
	{
		$this->shouldHaveType(GoogleChartWrapper::class);
	}


	function it_sets_the_data_to_be_rendered()
	{
		$this->setData([ 5, 2, 3 ])->shouldBeAnInstanceOf(GoogleChartWrapper::class);
	}


	function it_renders_the_url_with_the_default_values()
	{
		$expected = 'http://chart.apis.google.com/chart?cht=p3&chs=450x200&chd=t:5,2,3';
		$this->setData([ 5, 2, 3 ])->getSrc()->shouldBeEqualTo($expected);
	}


	function it_changes_the_size_of_the_chart()
	{
		$expected = 'http://chart.apis.google.com/chart?cht=p3&chs=200x200&chd=t:5,2,3';
		$this->setData([ 5, 2, 3 ])->setSize(200, 200)->shouldBeAnInstanceOf(GoogleChartWrapper::class);
		$this->getSize()->shouldBeEqualTo('200x200');
		$this->getSrc()->shouldBeEqualTo($expected);
	}


	function it_sets_the_base_color_of_the_chart()
	{
		$expected = 'http://chart.apis.google.com/chart?cht=p3&chs=450x200&chd=t:5,2,3&chco=00ffff';
		$this->setData([ 5, 2, 3 ])->setBaseColor([ 0, 255, 255 ])->shouldBeAnInstanceOf(GoogleChartWrapper::class);
		$this->getSrc()->shouldBeEqualTo($expected);
		$expected = 'http://chart.apis.google.com/chart?cht=p3&chs=450x200&chd=t:5,2,3&chco=000000,ffffff';
		$this->setGradientColor([ 0, 0, 0 ], [ 255, 255, 255 ])->shouldBeAnInstanceOf(GoogleChartWrapper::class);
		$this->getSrc()->shouldBeEqualTo($expected);
		$expected = 'http://chart.apis.google.com/chart?cht=p3&chs=450x200&chd=t:5,2,3&chco=ff0000|00ff00|0000ff';
		$this->setColors([ [ 255, 0, 0 ], [ 0, 255, 0 ], [ 0, 0, 255 ] ])
			 ->shouldBeAnInstanceOf(GoogleChartWrapper::class);
		$this->getSrc()->shouldBeEqualTo($expected);
	}


	function it_sets_the_labels_of_the_chart()
	{
		$expected = 'http://chart.apis.google.com/chart?cht=p3&chs=450x200&chd=t:5,2,3&chl=Five|Two|Four';
		$this->setData([ 5, 2, 3 ])
			 ->setLabels([ 'Five', 'Two', 'Four' ])
			 ->shouldBeAnInstanceOf(GoogleChartWrapper::class);
		$this->getSrc()->shouldBeEqualTo($expected);
	}


	function it_sets_the_title_for_the_chart()
	{
		$expected = 'http://chart.apis.google.com/chart?cht=p3&chs=450x200&chd=t:5,2,3&chtt=Chart+Title';
		$this->setData([ 5, 2, 3 ])
			 ->setTitle('Chart Title')
			 ->shouldBeAnInstanceOf(GoogleChartWrapper::class);
		$this->getSrc()->shouldBeEqualTo($expected);
	}

}
