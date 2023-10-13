# ☁️ Track Cloud Provider IPs

Track IP ranges in use by cloud providers and determine if IP addresses are associated with them. Compatable with both IPv4 and IPv6.

**Cloud providers currently supported:**
* Amazon Web Services
* Google Cloud Platform

**Coming Soon:**
* Azure
* Cloudflare

## Installation

You can install the package via composer:

``` bash
composer require michaelcrowcroft/laravel-cloud-ip
```

The package will automatically register itself.

While the package doesn't publish a migration file, you do need to run its migrations before using.

``` bash
php artisan migrate
```

Now that you have migrated the `cloud_ip` table you can use the provided artisan command to populate the table with cloud provider's published IP ranges.

``` bash
php artisan cloudip:get
```

## Usage

Once the package is installed you can access information about the IP addresses cloud providers are using through `CloudIP` model. A list of th fields associated are below. This can be used like any other eloquent model.

A method is provided to select a record associated with an IP. We only select the first record, because one IP might be in multiple ranges that cloud providers use for difference services. Ultimately they will all come back to the same cloud provider though. This accepts an IP address as a long, hex, or in dot notation (as a string).

``` php
public function cloudIP()
{
    public static function HasIP($ip): self|null
    {
        $ip = IP::parse($ip);

        return CloudIP::where('first_ip', '<=', $ip->toLong())
            ->where('last_ip', '>=', $ip->toLong())
            ->first();
    }
}
```

This can be used as follows, returning the single CloudIP record that the IP is associated with if it is in fact associated with a cloud provider.

``` php
CloudIP::hasIP('3.2.34.0')->get();
```

## Provided Fields

* **ip_prefix:** A range of IPs in CIDR notation.
* **first_ip:** The first IP in the range as a long.
* **last_ip:** The last IP in the range as a long.
* **type:** Whether an IP range is IPv4 or IPv6.
* **provider:** The cloud provider the IP range is associated with.

## Extra Tip

Cloud providers don't often change their IP addresses in use, but it can be worth setting up provided artisan command to run weekly in the scheduler to make sure your Cloud IP data is up to date.

``` php
// In your app/Console/Kernel.php file
protected function schedule(Schedule $schedule): void
{
    $schedule->command('cloudip:get')->weekly();
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
