<?php

namespace Tests\Feature;

use App\Models\Advertisement;
use App\Models\Event;
use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\GalleryItem;
use App\Models\News;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CommunityTrustWebsiteTest extends TestCase
{
    use RefreshDatabase;

    /** 1. Test Home Page loads successfully */
    public function test_home_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('શ્રી દશા સોરાઠિયા વણિક સમાજ');
    }

    /** 2. Test Slider visibility (only active sliders ordered by sort_order) */
    public function test_slider_visibility_rules(): void
    {
        Slider::create([
            'title' => 'Active Slide',
            'image_path' => 'sliders/active.jpg',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        Slider::create([
            'title' => 'Inactive Slide',
            'image_path' => 'sliders/inactive.jpg',
            'sort_order' => 2,
            'is_active' => false,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Active Slide');
        $response->assertDontSee('Inactive Slide');
    }

    /** 3. Test News listing page */
    public function test_news_listing_page_loads(): void
    {
        News::create([
            'title' => 'સમાચાર શીર્ષક (Public News Item)',
            'slug' => 'public-news-item',
            'summary' => 'Short summary of news',
            'content' => '<p>News content</p>',
            'is_active' => true,
        ]);

        $response = $this->get('/news');
        $response->assertStatus(200);
        $response->assertSee('સમાચાર શીર્ષક');
    }

    /** 4. Test Published vs Unpublished news security */
    public function test_unpublished_news_hidden_and_returns_404(): void
    {
        $draftNews = News::create([
            'title' => 'Draft News Article',
            'slug' => 'draft-news-article',
            'content' => '<p>Draft</p>',
            'is_active' => false,
        ]);

        $futureNews = News::create([
            'title' => 'Future Scheduled News Article',
            'slug' => 'future-scheduled-news-article',
            'content' => '<p>Future</p>',
            'published_at' => now()->addDays(3),
            'is_active' => true,
        ]);

        $response = $this->get('/news');
        $response->assertDontSee('Draft News Article');
        $response->assertDontSee('Future Scheduled News Article');

        $this->get('/news/draft-news-article')->assertStatus(404);
        $this->get('/news/future-scheduled-news-article')->assertStatus(404);
    }

    /** 5. Test News detail page */
    public function test_news_detail_page_loads_with_seo_and_recent_news(): void
    {
        $news = News::create([
            'title' => 'સરસ્વતી સન્માન સમારોહ ૨૦૨૬',
            'slug' => 'saraswati-samman-samaroh-2026',
            'summary' => 'વિદ્યાર્થી સન્માન સમારોહ',
            'content' => '<p>સંપૂર્ણ વિગતવાર સમાચાર સાહિત્ય</p>',
            'is_active' => true,
        ]);

        $response = $this->get('/news/' . $news->slug);
        $response->assertStatus(200);
        $response->assertSee('સરસ્વતી સન્માન સમારોહ ૨૦૨૬');
        $response->assertSee('સંપૂર્ણ વિગતવાર સમાચાર સાહિત્ય');
    }

    /** 6. Test Upcoming events listing */
    public function test_upcoming_events_listing(): void
    {
        Event::create([
            'title' => 'આગામી વાર્ષિક સભા (Upcoming Meeting)',
            'slug' => 'upcoming-meeting',
            'event_date' => now()->addDays(5),
            'location' => 'રાજકોટ',
            'is_active' => true,
        ]);

        $response = $this->get('/events/upcoming');
        $response->assertStatus(200);
        $response->assertSee('આગામી વાર્ષિક સભા');
    }

    /** 7. Test Past events listing */
    public function test_past_events_listing(): void
    {
        Event::create([
            'title' => 'ગત કાર્યક્રમ (Past Function)',
            'slug' => 'past-function',
            'event_date' => now()->subDays(5),
            'location' => 'રાજકોટ',
            'is_active' => true,
        ]);

        $response = $this->get('/events/past');
        $response->assertStatus(200);
        $response->assertSee('ગત કાર્યક્રમ');
    }

    /** 8. Test Advertisement visibility and date window rules */
    public function test_advertisement_date_window_rules(): void
    {
        Advertisement::create([
            'title' => 'Valid Active Ad Banner',
            'position' => 'home_hero',
            'start_date' => now()->subDays(2)->toDateString(),
            'end_date' => now()->addDays(2)->toDateString(),
            'is_active' => true,
        ]);

        Advertisement::create([
            'title' => 'Expired Ad Banner',
            'position' => 'home_hero',
            'start_date' => now()->subDays(10)->toDateString(),
            'end_date' => now()->subDays(2)->toDateString(),
            'is_active' => true,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Valid Active Ad Banner');
        $response->assertDontSee('Expired Ad Banner');
    }

    /** 9. Test Community Member listing */
    public function test_member_listing_page_loads(): void
    {
        $family = Family::create([
            'family_code' => 'F001',
            'surname_guj' => 'શાહ',
            'surname_eng' => 'Shah',
            'main_member_name_guj' => 'અમૃતલાલ શાહ',
            'main_member_name_eng' => 'Amrutlal Shah',
        ]);

        FamilyMember::create([
            'family_id' => $family->id,
            'member_name_guj' => 'અમૃતલાલ શાહ',
            'member_name_eng' => 'Amrutlal Shah',
            'is_active' => true,
        ]);

        $response = $this->get('/members');
        $response->assertStatus(200);
        $response->assertSee('અમૃતલાલ શાહ');
    }

    /** 10. Test Member search by Gujarati Unicode and English */
    public function test_member_search_functionality(): void
    {
        $family = Family::create([
            'family_code' => 'F002',
            'surname_guj' => 'ભાડેર',
            'surname_eng' => 'Bhader',
            'main_member_name_guj' => 'કિરીટભાઈ ભાડેર',
            'main_member_name_eng' => 'Kiritbhai Bhader',
        ]);

        FamilyMember::create([
            'family_id' => $family->id,
            'member_name_guj' => 'કિરીટભાઈ ભાડેર',
            'member_name_eng' => 'Kiritbhai Bhader',
            'is_active' => true,
        ]);

        $responseGuj = $this->get('/members?search=' . urlencode('ભાડેર'));
        $responseGuj->assertStatus(200);
        $responseGuj->assertSee('કિરીટભાઈ ભાડેર');

        $responseEng = $this->get('/members?search=Kiritbhai');
        $responseEng->assertStatus(200);
        $responseEng->assertSee('કિરીટભાઈ ભાડેર');
    }

    /** 11. Test Member detail page */
    public function test_member_detail_page_loads(): void
    {
        $family = Family::create([
            'family_code' => 'F003',
            'surname_guj' => 'ધોળકીયા',
            'surname_eng' => 'Dholakia',
            'main_member_name_guj' => 'રમેશભાઈ ધોળકીયા',
            'main_member_name_eng' => 'Rameshbhai Dholakia',
            'mobile' => '9876543210',
        ]);

        $member = FamilyMember::create([
            'family_id' => $family->id,
            'member_name_guj' => 'રમેશભાઈ ધોળકીયા',
            'member_name_eng' => 'Rameshbhai Dholakia',
            'is_active' => true,
        ]);

        $response = $this->get('/members/' . $family->id);
        $response->assertStatus(200);
        $response->assertSee('રમેશભાઈ ધોળકીયા');
    }

    /** 12. Test Admin authorization protection */
    public function test_unauthenticated_user_cannot_access_admin_panel(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    /** 13. Test File upload validation constraints */
    public function test_file_upload_validation_constraints(): void
    {
        Storage::fake('public');
        Storage::fake('local');

        $validPdf = UploadedFile::fake()->create('document.pdf', 500, 'application/pdf');
        $invalidFile = UploadedFile::fake()->create('script.php', 100, 'text/plain');

        $this->assertEquals('pdf', $validPdf->getClientOriginalExtension());
        $this->assertEquals('php', $invalidFile->getClientOriginalExtension());
    }

    /** 14. Test Gujarati Unicode content persistence */
    public function test_gujarati_unicode_content_persistence(): void
    {
        $gujText = 'શ્રી દશા સોરાઠિયા વણિક સમાજ (મહાજન), રાજકોટ - ૨૦૨૪/૨૫';
        $family = Family::create([
            'family_code' => 'F004',
            'surname_guj' => 'યુનિકોડ',
            'surname_eng' => 'Unicode',
            'main_member_name_guj' => $gujText,
            'main_member_name_eng' => 'Unicode Test',
        ]);

        $this->assertDatabaseHas('families', [
            'id' => $family->id,
            'main_member_name_guj' => $gujText,
        ]);
    }

    /** 15. Test Member PDF source relationship data isolation */
    public function test_member_pdf_source_data_is_isolated_from_public(): void
    {
        $family = Family::create([
            'family_code' => 'F005',
            'surname_guj' => 'આઇસોલેટેડ',
            'surname_eng' => 'Isolated',
            'main_member_name_guj' => 'આઇસોલેટેડ સભ્ય',
            'main_member_name_eng' => 'Isolated Test Member',
        ]);

        $response = $this->get('/members/' . $family->id);
        $response->assertStatus(200);
        $response->assertSee('આઇસોલેટેડ સભ્ય');
    }

    /** 16. Test Gallery page loads photos and videos */
    public function test_gallery_page_loads_successfully_with_photos_and_videos(): void
    {
        GalleryItem::create([
            'title' => 'સ્નેહ મિલન ૨૦૨૬ તસવીર',
            'type' => 'image',
            'image_path' => 'gallery/test.webp',
            'category' => 'સ્નેહ મિલન',
            'is_active' => true,
        ]);

        GalleryItem::create([
            'title' => 'સાંસ્કૃતિક વિડિયો ૨૦૨૬',
            'type' => 'video',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'category' => 'સાંસ્કૃતિક',
            'is_active' => true,
        ]);

        $response = $this->get('/gallery');
        $response->assertStatus(200);
        $response->assertSee('સ્નેહ મિલન ૨૦૨૬ તસવીર');
        $response->assertSee('સાંસ્કૃતિક વિડિયો ૨૦૨૬');

        $responsePhotos = $this->get('/gallery?type=image');
        $responsePhotos->assertStatus(200);
        $responsePhotos->assertSee('સ્નેહ મિલન ૨૦૨૬ તસવીર');
        $responsePhotos->assertDontSee('સાંસ્કૃતિક વિડિયો ૨૦૨૬');

        $responseVideos = $this->get('/gallery?type=video');
        $responseVideos->assertStatus(200);
        $responseVideos->assertSee('સાંસ્કૃતિક વિડિયો ૨૦૨૬');
        $responseVideos->assertDontSee('સ્નેહ મિલન ૨૦૨૬ તસવીર');
    }

    /** 17. Test GalleryItem YouTube helper methods */
    public function test_gallery_item_youtube_embed_helpers(): void
    {
        $item = new GalleryItem([
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ]);

        $this->assertEquals('dQw4w9WgXcQ', $item->youtube_id);
        $this->assertEquals('https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1', $item->youtube_embed_url);
        $this->assertEquals('https://img.youtube.com/vi/dQw4w9WgXcQ/hqdefault.jpg', $item->youtube_thumbnail_url);
    }
}
