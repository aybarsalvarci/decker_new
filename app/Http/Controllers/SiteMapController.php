<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Report;
use Illuminate\Http\Response;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SiteMapController extends Controller
{
    public function index(): Response
    {
        $locales = LaravelLocalization::getSupportedLanguagesKeys();
        $categories = Category::all();
        $news = Report::all();

        $staticUrls = $this->generateStaticUrls($locales);

        return response()
            ->view('sitemap', [
                'staticUrls' => $staticUrls,
                'categories' => $categories,
                'news' => $news,
                'locales' => $locales
            ])
            ->header('Content-Type', 'application/xml');
    }

    private function generateStaticUrls(array $locales): array
    {
        $staticRoutes = [
            'home' => ['key' => 'home', 'nested' => false],
            'about' => ['key' => 'about', 'nested' => false],
            'faq' => ['key' => 'faq', 'nested' => false],
            'estimate-cost' => ['key' => 'estimate_cost', 'nested' => false],
            'free-samples' => ['key' => 'free_samples', 'nested' => false],
            'contact' => ['key' => 'contact', 'nested' => false],
            'resources.main' => ['key' => 'resources.main', 'nested' => false],
            'resources.catalog' => ['key' => 'resources.catalog', 'nested' => true, 'parent' => 'resources.main'],
            'resources.warranties' => ['key' => 'resources.warranties', 'nested' => true, 'parent' => 'resources.main'],
            'resources.care-and-maintenance' => ['key' => 'resources.care_and_maintenance', 'nested' => true, 'parent' => 'resources.main'],
            'resources.installation-guides' => ['key' => 'resources.installation_guides', 'nested' => true, 'parent' => 'resources.main'],
            'resources.technical-certificates' => ['key' => 'resources.technical_certificates', 'nested' => true, 'parent' => 'resources.main'],
            'resources.get-inspired-page' => ['key' => 'resources.get_inspired_page', 'nested' => true, 'parent' => 'resources.main'],
        ];

        $staticUrls = [];

        foreach ($staticRoutes as $routeName => $config) {
            $alternates = [];
            $defaultUrl = route($routeName);

            foreach ($locales as $locale) {
                if ($locale === 'en') {
                    $alternates[$locale] = route($routeName);
                } else {
                    $alternates[$locale] = $this->buildLocalizedUrl($locale, $routeName, $config);
                }
            }

            $staticUrls[] = [
                'loc' => $defaultUrl,
                'lastmod' => now()->toAtomString(),
                'priority' => $this->getPriority($routeName),
                'alternates' => $alternates
            ];
        }

        return $staticUrls;
    }

    /**
     * Build localized URL for nested and non-nested routes
     */
    private function buildLocalizedUrl(string $locale, string $routeName, array $config): string
    {
        $translationKey = $config['key'];

        if ($config['nested']) {
            
            $parentKey = str_replace('.', '.', explode('.', $config['parent'])[1]); 
            $childKey = str_replace('.', '.', explode('.', $translationKey)[1]); // 

            $parentPath = trans("routes.resources.{$parentKey}", [], $locale);
            $childPath = trans("routes.resources.{$childKey}", [], $locale);

            $fullPath = $parentPath . '/' . $childPath;

            return LaravelLocalization::getLocalizedURL($locale, $fullPath);
        } else {
            
            if ($translationKey === 'home') {
                return LaravelLocalization::getLocalizedURL($locale, '/');
            }

            $path = trans("routes.{$translationKey}", [], $locale);
            return LaravelLocalization::getLocalizedURL($locale, $path);
        }
    }

    /**
     * Get priority value for different route types
     */
    private function getPriority(string $routeName): string
    {
        $priorities = [
            'home' => '1.0',
            'resources.get-inspired-page' => '0.9',
            'resources.main' => '0.8',
            'about' => '0.8',
            'contact' => '0.8',
        ];

        return $priorities[$routeName] ?? '0.7';
    }
}
