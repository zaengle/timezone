# Timezone Select Form Builder
This package is a fork from [Camron Cade](https://github.com/camroncade/timezone) 
modified to fit Zaengle's usage. For more information, read Camron's [helpful article](https://www.camroncade.com/managing-timezones-with-laravel/) on managing timezones in Laravel.
The array of timezones and their underlying keys were taken from the repository by [tamaspap](https://github.com/tamaspap/timezones).

## Installation

Recommended installation of this package is through composer. Run the following snippet to add Timezone to your project:

    composer require zaengle/timezone

_**Note:** You may jump to Usage if you are on Laravel 5.5+_

Once this operation completes, the final step is to add the service provider. Open `config/app.php`, and add a new item to the service providers array.

    'Zaengle\Timezone\TimezoneServiceProvider'
    
In order to use the Facade, update the aliases array as such:

	`Timezone` => `Zaengle\Timezone\Facades\Timezone`,
	
Now it's ready for use!

## Usage

### Timezone Convert Helper Functions

The package includes two helper functions that make it easy to deal with displaying and storing timezones, `convertFromUTC()` and `convertToUTC()`:

Each function accepts two required parameters and a third optional parameter dealing with the format of the returned timestamp.

    Timezone::convertFromUTC($timestamp, $timezone, $format);
    Timezone::convertToUTC($timestamp, $timezone, $format);

The first parameter accepts a timestamp, the second accepts the name of the timezone that you are converting to/from. The option values associated with the timezones included in the select form builder can be plugged into here as is. Alternatively, you can use any of [PHP's supported timezones](http://php.net/manual/en/timezones.php).

The third parameter is optional, and default is set to `'Y-m-d H:i:s'`, which is how Laravel natively stores datetimes into the database (the `created_at` and `updated_at` columns).

### Building a select form

Using the `Timezone::toSelectArray()` you can build an array of enabled timezones similar to this:

	[
        "(UTC-08:00) Pacific Time (US &amp; Canada)" => "America/Los_Angeles",
        "(UTC-07:00) Mountain Time (US &amp; Canada)" => "US/Mountain",
        "(UTC-06:00) Central Time (US &amp; Canada)" => "US/Central",
        "(UTC-05:00) Eastern Time (US &amp; Canada)" => "US/Eastern",
	]
	
Then, in your Blade template you have control over formatting:

    <select name="timezone" id="timezone">
        @foreach(Timezone::toSelectArray() as $key=>$val)
            <option value="{{ $val }}" @if($union->timezone === $val) selected @endif>{!! $key !!}</option>
        @endforeach
    </select>
    
### Customizing timezones

If you want to customize which timezones are displayed in the `toSelectArray()` method, publish the package configuration file and enable/disable individual timezones:

    php artisan vendor:publish --tag=config --provider="Zaengle\Timezone\TimezoneServiceProvider"

    
### Credits

 [Camron Cade](https://github.com/camroncade/timezone)