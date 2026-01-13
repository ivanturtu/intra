<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Form extends Component
{
    use WithFileUploads;

    public $siteTitle = '';
    public $siteDescription = '';
    public $logo;
    public $logoPath;
    public $favicon;
    public $faviconPath;
    public $facebookUrl = '';
    public $linkedinUrl = '';
    public $instagramUrl = '';
    public $address = '';
    public $phone = '';
    public $email = '';
    public $privacyPolicy = '';
    public $metaTitle = '';
    public $metaDescription = '';
    public $metaKeywords = '';
    public $ogTitle = '';
    public $ogDescription = '';
    public $ogImage;
    public $ogImagePath;
    public $twitterCardTitle = '';
    public $twitterCardDescription = '';
    public $twitterCardImage;
    public $twitterCardImagePath;

    protected function rules()
    {
        return [
            'siteTitle' => 'nullable|string|max:255',
            'siteDescription' => 'nullable|string',
            'logo' => 'nullable|image|max:10240',
            'favicon' => 'nullable|image|max:2048',
            'facebookUrl' => 'nullable|url|max:255',
            'linkedinUrl' => 'nullable|url|max:255',
            'instagramUrl' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'privacyPolicy' => 'nullable|string',
            'metaTitle' => 'nullable|string|max:255',
            'metaDescription' => 'nullable|string|max:500',
            'metaKeywords' => 'nullable|string|max:500',
            'ogTitle' => 'nullable|string|max:255',
            'ogDescription' => 'nullable|string|max:500',
            'ogImage' => 'nullable|image|max:10240',
            'twitterCardTitle' => 'nullable|string|max:255',
            'twitterCardDescription' => 'nullable|string|max:500',
            'twitterCardImage' => 'nullable|image|max:10240',
        ];
    }

    public function mount()
    {
        $settings = Setting::getSettings();
        $this->siteTitle = $settings->site_title ?? '';
        $this->siteDescription = $settings->site_description ?? '';
        $this->logoPath = $settings->logo;
        $this->faviconPath = $settings->favicon;
        $this->facebookUrl = $settings->facebook_url ?? '';
        $this->linkedinUrl = $settings->linkedin_url ?? '';
        $this->instagramUrl = $settings->instagram_url ?? '';
        $this->address = $settings->address ?? '';
        $this->phone = $settings->phone ?? '';
        $this->email = $settings->email ?? '';
        $this->privacyPolicy = $settings->privacy_policy ?? '';
        $this->metaTitle = $settings->meta_title ?? '';
        $this->metaDescription = $settings->meta_description ?? '';
        $this->metaKeywords = $settings->meta_keywords ?? '';
        $this->ogTitle = $settings->og_title ?? '';
        $this->ogDescription = $settings->og_description ?? '';
        $this->ogImagePath = $settings->og_image;
        $this->twitterCardTitle = $settings->twitter_card_title ?? '';
        $this->twitterCardDescription = $settings->twitter_card_description ?? '';
        $this->twitterCardImagePath = $settings->twitter_card_image;
    }

    public function save()
    {
        $this->validate();

        $settings = Setting::getSettings();

        $data = [
            'site_title' => $this->siteTitle,
            'site_description' => $this->siteDescription,
            'facebook_url' => $this->facebookUrl,
            'linkedin_url' => $this->linkedinUrl,
            'instagram_url' => $this->instagramUrl,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'privacy_policy' => $this->privacyPolicy,
            'meta_title' => $this->metaTitle,
            'meta_description' => $this->metaDescription,
            'meta_keywords' => $this->metaKeywords,
            'og_title' => $this->ogTitle,
            'og_description' => $this->ogDescription,
            'twitter_card_title' => $this->twitterCardTitle,
            'twitter_card_description' => $this->twitterCardDescription,
        ];

        // Handle logo upload
        if ($this->logo) {
            if ($this->logoPath && Storage::disk('public')->exists($this->logoPath)) {
                Storage::disk('public')->delete($this->logoPath);
            }
            $data['logo'] = $this->logo->store('settings', 'public');
        } elseif ($this->logoPath) {
            $data['logo'] = $this->logoPath;
        }

        // Handle favicon upload
        if ($this->favicon) {
            if ($this->faviconPath && Storage::disk('public')->exists($this->faviconPath)) {
                Storage::disk('public')->delete($this->faviconPath);
            }
            $data['favicon'] = $this->favicon->store('settings', 'public');
        } elseif ($this->faviconPath) {
            $data['favicon'] = $this->faviconPath;
        }

        // Handle OG image upload
        if ($this->ogImage) {
            if ($this->ogImagePath && Storage::disk('public')->exists($this->ogImagePath)) {
                Storage::disk('public')->delete($this->ogImagePath);
            }
            $data['og_image'] = $this->ogImage->store('settings', 'public');
        } elseif ($this->ogImagePath) {
            $data['og_image'] = $this->ogImagePath;
        }

        // Handle Twitter Card image upload
        if ($this->twitterCardImage) {
            if ($this->twitterCardImagePath && Storage::disk('public')->exists($this->twitterCardImagePath)) {
                Storage::disk('public')->delete($this->twitterCardImagePath);
            }
            $data['twitter_card_image'] = $this->twitterCardImage->store('settings', 'public');
        } elseif ($this->twitterCardImagePath) {
            $data['twitter_card_image'] = $this->twitterCardImagePath;
        }

        $settings->update($data);
        session()->flash('message', 'Settings updated successfully.');

        return redirect()->route('admin.settings.index');
    }

    public function render()
    {
        return view('livewire.admin.settings.form');
    }
}
