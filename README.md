## Usage

Add a method to your model with an IP address (stored as a long), and see whether it is within a range associated with a Cloud provider.
```
public function cloudIP()
{
    return $this->belongsTo(CloudIP::class, function ($query) {
        $query->where('clicks.ip', '>=', 'cloud_ips.first_ip')
            ->where('clicks.ip', '<=', 'cloud_ips.last_ip');
    });
}
```