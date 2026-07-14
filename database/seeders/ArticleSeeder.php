<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $finance = Category::where('slug', 'finance')->first();
        $cryptocurrency = Category::where('slug', 'cryptocurrency')->first();
        $entertainment = Category::where('slug', 'entertainment')->first();
        $business = Category::where('slug', 'business')->first();

        $articles = [
            [
                'title' => 'SolanumCrown Investment Announces Rebrand to "SolanumChain" Following Completion of Extended Platform Maintenance',
                'slug' => 'solanumcrown-investment-announces-rebrand-to-solanumchain-following-completion-of-extended-platform-maintenance',
                'excerpt' => 'NewsRealm reports that SolanumCrown Investment has officially completed its long-awaited platform maintenance and has announced a comprehensive corporate rebranding.',
                'body' => '<p>NewsRealm reports that SolanumCrown Investment has officially completed its long-awaited platform maintenance and has announced a comprehensive corporate rebranding. The company will now operate under the name "SolanumChain" as it pivots toward a broader blockchain-focused investment strategy.</p><p>The rebrand comes after an extensive period of platform upgrades that saw the company expand its infrastructure and investment options for clients. The new brand identity reflects the company\'s commitment to leveraging blockchain technology for modern investment solutions.</p>',
                'featured_image' => 'assets/uploads/20260701-175252-2eeb5871.jpg',
                'category_id' => $finance->id,
                'author_name' => 'NewsRealm',
                'published_at' => '2026-06-30 10:00:00',
                'is_trending' => true,
                'is_editor_pick' => false,
            ],

            [
                'title' => 'Blake Lively and Justin Baldoni\'s Wayfarer reach settlement, two weeks ahead of trial start',
                'slug' => 'blake-lively-and-justin-baldoni-s-wayfarer-reach-settlement-two-weeks-ahead-of-trial-start',
                'excerpt' => 'Blake Lively and Justin Baldoni\'s Wayfarer have reached a settlement, bringing an end to the legal dispute two weeks before the trial was set to begin.',
                'body' => '<p>Blake Lively and Justin Baldoni\'s Wayfarer have reached a settlement, bringing an end to the legal dispute two weeks before the trial was set to begin. Details of the settlement remain confidential, but sources close to the matter indicate both parties are satisfied with the resolution.</p><p>The case had drawn significant media attention since it was first filed, with many industry observers closely watching the proceedings. The settlement avoids what would have been a lengthy and public court battle.</p>',
                'featured_image' => 'assets/uploads/20260630-005318-c40a85c8.jpg',
                'category_id' => $entertainment->id,
                'author_name' => 'NewsRealm',
                'published_at' => '2026-06-29 14:00:00',
                'is_trending' => true,
                'is_editor_pick' => true,
            ],

            [
                'title' => 'Bitcoin ticks up above $60k, but heads for quarterly loss as ETF outflows persist',
                'slug' => 'bitcoin-ticks-up-above-60k-but-heads-for-quarterly-loss-as-etf-outflows-persist',
                'excerpt' => 'Bitcoin briefly ticked above the $60,000 mark, but the leading cryptocurrency is still headed for a quarterly loss as persistent ETF outflows weigh on sentiment.',
                'body' => '<p>Bitcoin briefly ticked above the $60,000 mark on Friday, but the leading cryptocurrency is still headed for a quarterly loss as persistent ETF outflows continue to weigh on market sentiment.</p><p>Analysts point to a combination of macroeconomic headwinds and regulatory uncertainty as key factors driving the sell-off. Despite the short-term price pressures, long-term holders remain confident in Bitcoin\'s fundamentals.</p>',
                'featured_image' => 'assets/uploads/20260630-004339-c606e452.jpg',
                'category_id' => $cryptocurrency->id,
                'author_name' => 'NewsRealm',
                'published_at' => '2026-06-27 09:30:00',
                'is_trending' => true,
                'is_editor_pick' => true,
                'is_lead' => true,
            ],

            [
                'title' => 'Solanumcrown Investment Announces Planned Rebrand to SolanumChain Investment as Platform Upgrade Nears Completion',
                'slug' => 'solanumcrown-investment-announces-planned-rebrand-to-solanumchain-investment-as-platform-upgrade-nears-completion',
                'excerpt' => 'Solanumcrown Investment has announced its planned rebrand to SolanumChain Investment as its platform upgrade nears completion.',
                'body' => '<p>Solanumcrown Investment has announced its planned rebrand to SolanumChain Investment as its platform upgrade nears completion. The transition marks a significant milestone for the company as it prepares to launch its enhanced investment platform.</p><p>The rebrand reflects the company\'s strategic shift toward blockchain-integrated financial services, positioning itself at the intersection of traditional investment and decentralized technology.</p>',
                'featured_image' => 'assets/uploads/20260629-225427-63d001f8.jpg',
                'category_id' => $finance->id,
                'author_name' => 'NewsRealm',
                'published_at' => '2026-06-25 11:00:00',
                'is_trending' => true,
                'is_editor_pick' => false,
            ],

            [
                'title' => 'Canada\'s Unifor union begins Detroit Three negotiations with Ford',
                'slug' => 'canada-s-unifor-union-begins-detroit-three-negotiations-with-ford',
                'excerpt' => 'Canadian auto union Unifor began negotiations with Ford Motor on Monday, commencing talks on new contracts with the so-called Detroit Three of Ford, General Motors and Stellantis.',
                'body' => '<p>DETROIT, June 22 (Reuters) - Canadian auto union Unifor began negotiations with Ford Motor on Monday, commencing talks on new contracts with the so-called Detroit Three of Ford, General Motors and Stellantis to try to improve pay, job security and benefits for its nearly 19,000 members at those companies.</p><p>The negotiations are being closely watched as a bellwether for labor relations in the automotive sector, with union leaders signaling that they are seeking significant improvements in wages and working conditions.</p>',
                'featured_image' => 'assets/uploads/20260622-215847-09d28809.webp',
                'category_id' => $finance->id,
                'author_name' => 'NewsRealm',
                'published_at' => '2026-06-22 16:00:00',
                'is_trending' => false,
                'is_editor_pick' => false,
            ],

            [
                'title' => 'Dollar hits over one-yr high on hawkish Fed; sterling recovers after Starmer exit',
                'slug' => 'dollar-hits-over-one-yr-high-on-hawkish-fed-sterling-recovers-after-starmer-exit',
                'excerpt' => 'The U.S. dollar on Monday surged to an over one-year high, as rising expectations for a hawkish Federal Reserve outweighed positive developments in the Middle East and falling oil prices.',
                'body' => '<p>Investing.com -- The U.S. dollar on Monday surged to an over one-year high, as rising expectations for a hawkish Federal Reserve outweighed positive developments in the Middle East and falling oil prices. Meanwhile, the sterling was in focus amid the big story of the day in British Prime Minister Keir Starmer\'s resignation.</p><p>Currency markets remain volatile as traders price in the implications of shifting central bank policies and geopolitical developments across multiple regions.</p>',
                'featured_image' => 'assets/uploads/20260622-222722-3875988e.jpg',
                'category_id' => $finance->id,
                'author_name' => 'NewsRealm',
                'published_at' => '2026-06-22 14:00:00',
                'is_trending' => false,
                'is_editor_pick' => false,
            ],

            [
                'title' => 'Solanumcrown Announces Platform Upgrade and Expansion of Investment Options',
                'slug' => 'solanumcrown-announces-platform-upgrade-and-expansion-of-investment-options',
                'excerpt' => 'Solanumcrown has announced that its investment platform is currently undergoing a major maintenance and upgrade process.',
                'body' => '<p>Solanumcrown has announced that its investment platform is currently undergoing a major maintenance and upgrade process. The upgrade is expected to bring new features and expanded investment options to the platform\'s growing user base.</p><p>The company has assured users that their funds remain secure during the maintenance period and that the enhanced platform will offer a significantly improved trading experience upon completion.</p>',
                'featured_image' => 'assets/uploads/20260621-194404-376faa3e.jpg',
                'category_id' => $finance->id,
                'author_name' => 'NewsRealm',
                'published_at' => '2026-06-22 10:00:00',
                'is_trending' => false,
                'is_editor_pick' => false,
            ],

            [
                'title' => 'Alphabet weighs on S&P and Nasdaq while Dow holds gains in mixed trading',
                'slug' => 'alphabet-weighs-on-s-p-and-nasdaq-while-dow-holds-gains-in-mixed-trading',
                'excerpt' => 'Wall Street was mixed on Monday, as a slide in Alphabet weighed on the heavyweight communication services sector.',
                'body' => '<p>Investing.com -- Wall Street was mixed on Monday, as a slide in Alphabet weighed on the heavyweight communication services sector. Investors also parsed turbulent Middle East developments that ranged from fresh fighting between Israel and Lebanon over the weekend to the U.S. and Iran touting progress in peace talks held in Switzerland.</p><p>The mixed trading session reflected the uncertainty gripping global markets as geopolitical tensions and monetary policy concerns continue to drive volatility.</p>',
                'featured_image' => 'assets/uploads/20260622-210148-3d7a8f52.jpg',
                'category_id' => $finance->id,
                'author_name' => 'NewReality',
                'published_at' => '2026-06-22 12:00:00',
                'is_trending' => false,
                'is_editor_pick' => false,
            ],

            [
                'title' => 'Joseph Lubin defends Vitalik Buterin\'s Ethereum fiction project',
                'slug' => 'joseph-lubin-defends-vitalik-buterin-s-ethereum-fiction-project',
                'excerpt' => 'Ethereum co-founder Joseph Lubin defended Vitalik Buterin after some community members questioned Buterin\'s decision to write a science-fiction novel focused on decentralized governance.',
                'body' => '<p>Ethereum co-founder Joseph Lubin defended Vitalik Buterin after some community members questioned Buterin\'s decision to write a science-fiction novel focused on decentralized governance. Lubin argued that creative projects like this help expand the reach and understanding of blockchain technology to broader audiences.</p><p>The novel, which explores themes of decentralized decision-making and digital sovereignty, has sparked debate within the crypto community about the role of thought leadership in the space.</p>',
                'featured_image' => 'assets/uploads/20260621-232350-8d947af2.jpg',
                'category_id' => $business->id,
                'author_name' => 'Olivia Stephanie',
                'published_at' => '2026-06-21 15:00:00',
                'is_trending' => false,
                'is_editor_pick' => true,
            ],

            [
                'title' => 'SpaceX falls in premarket as analysts grow more cautious on valuation',
                'slug' => 'spacex-falls-in-premarket-as-analysts-grow-more-cautious-on-valuation',
                'excerpt' => 'SpaceX shares fell 4.6% in premarket trading after KeyBanc adopted a more cautious stance on the stock, arguing that its valuation has become increasingly stretched.',
                'body' => '<p>Investing.com -- SpaceX shares fell 4.6% in premarket trading after KeyBanc adopted a more cautious stance on the stock, arguing that its valuation has become increasingly stretched following a sharp post-IPO rally.</p><p>Analysts noted that while SpaceX continues to demonstrate strong operational performance, the current valuation multiples leave little room for error in execution. The downgrade reflects growing caution among Wall Street firms about the defense and aerospace sector.</p>',
                'featured_image' => 'assets/uploads/20260622-182641-b58cfdd2.jpg',
                'category_id' => $finance->id,
                'author_name' => 'Vahid Karaahmetovic',
                'published_at' => '2026-06-21 08:00:00',
                'is_trending' => false,
                'is_editor_pick' => false,
            ],

            [
                'title' => 'Luxury stocks fall as Iran war weighs on earnings; Hermes sinks 8%',
                'slug' => 'luxury-stocks-fall-as-iran-war-weighs-on-earnings-hermes-sinks-8',
                'excerpt' => 'Luxury stocks fell sharply as the ongoing conflict in Iran weighed on earnings expectations, with Hermes sinking 8% in a single trading session.',
                'body' => '<p>Luxury stocks fell sharply as the ongoing conflict in Iran weighed on earnings expectations, with Hermes sinking 8% in a single trading session. The broader luxury sector was hit hard as investors priced in the impact of geopolitical instability on consumer spending in key markets.</p><p>Analysts warned that the conflict could disrupt supply chains and dampen demand for high-end goods across the Middle East and beyond.</p>',
                'featured_image' => 'assets/uploads/20260613-164109-d472c2f0.jpg',
                'category_id' => $business->id,
                'author_name' => 'NewsRealm',
                'published_at' => '2026-06-13 11:00:00',
                'is_trending' => false,
                'is_editor_pick' => true,
            ],

            [
                'title' => 'Drugmakers race to find a place in the next wave of obesity drugs',
                'slug' => 'drugmakers-race-to-find-a-place-in-the-next-wave-of-obesity-drugs',
                'excerpt' => 'Pharmaceutical companies are racing to establish themselves in the rapidly growing obesity drug market as demand for effective treatments continues to surge.',
                'body' => '<p>Drugmakers are racing to find a place in the next wave of obesity drugs, with several major pharmaceutical companies investing heavily in research and development. The global obesity drug market is expected to grow significantly in the coming years as demand for effective treatments continues to surge.</p><p>Competition is intensifying as companies seek to capture market share in what analysts predict could become one of the most lucrative segments of the pharmaceutical industry.</p>',
                'featured_image' => 'assets/uploads/20260613-163807-900998c3.jpg',
                'category_id' => $business->id,
                'author_name' => 'NewsRealm',
                'published_at' => '2026-06-13 10:00:00',
                'is_trending' => false,
                'is_editor_pick' => true,
            ],

            [
                'title' => 'United CEO brushes off airline mergers after American rejection: There\'s nothing',
                'slug' => 'united-ceo-brushes-off-airline-mergers-after-american-rejection-there-s-nothing',
                'excerpt' => 'United Airlines CEO brushed off the prospect of further airline mergers following American Airlines\' rejection of consolidation talks, stating simply that "there\'s nothing" to pursue.',
                'body' => '<p>United Airlines CEO brushed off the prospect of further airline mergers following American Airlines\' rejection of consolidation talks, stating simply that "there\'s nothing" to pursue. The comments come after American Airlines publicly dismissed rumors of potential merger discussions between the two carriers.</p><p>The airline industry has seen significant consolidation over the past two decades, but regulatory hurdles and operational challenges have made further mergers increasingly difficult to execute.</p>',
                'featured_image' => 'assets/uploads/20260613-162056-730664ac.jpg',
                'category_id' => $business->id,
                'author_name' => 'NewsRealm',
                'published_at' => '2026-06-13 09:00:00',
                'is_trending' => false,
                'is_editor_pick' => true,
            ],

            [
                'title' => 'Trump opens door for crypto in retirement accounts',
                'slug' => 'trump-opens-door-for-crypto-in-retirement-accounts',
                'excerpt' => 'Former President Trump has opened the door for cryptocurrency investments in retirement accounts, signaling a potential shift in regulatory approach.',
                'body' => '<p>Former President Trump has opened the door for cryptocurrency investments in retirement accounts, signaling a potential shift in regulatory approach. The announcement has been met with both enthusiasm and caution from financial advisors and crypto advocates alike.</p><p>The move could pave the way for broader adoption of digital assets in traditional investment portfolios, though regulatory details remain to be worked out.</p>',
                'featured_image' => 'assets/uploads/20260610-143901-1bd79513.jpg',
                'category_id' => $cryptocurrency->id,
                'author_name' => 'NewsRealm',
                'published_at' => '2026-06-10 14:00:00',
                'is_trending' => false,
                'is_editor_pick' => true,
            ],

            [
                'title' => 'NewGenIVF invests additional $4 million in K25.ai at $100 million valuation',
                'slug' => 'newgenivf-invests-additional-4-million-in-k25-ai-at-100-million-valuation',
                'excerpt' => 'NewGenIVF has invested an additional $4 million in K25.ai, valuing the AI startup at $100 million as the healthcare technology sector continues to attract significant investment.',
                'body' => '<p>NewGenIVF has invested an additional $4 million in K25.ai, valuing the AI startup at $100 million as the healthcare technology sector continues to attract significant investment. The funding round underscores growing investor confidence in AI-driven healthcare solutions.</p><p>K25.ai specializes in developing artificial intelligence tools for fertility treatment optimization, a niche but rapidly growing segment of the healthcare technology market.</p>',
                'featured_image' => 'assets/uploads/20260610-140939-0519f484.jpg',
                'category_id' => $cryptocurrency->id,
                'author_name' => 'NewsRealm',
                'published_at' => '2026-06-10 10:00:00',
                'is_trending' => false,
                'is_editor_pick' => true,
            ],

            [
                'title' => 'Greece reportedly plans 15% capital gains tax on cryptocurrencies',
                'slug' => 'greece-reportedly-plans-15-capital-gains-tax-on-cryptocurrencies',
                'excerpt' => 'Greece is reportedly planning to introduce a 15% capital gains tax on cryptocurrency transactions, joining a growing list of countries seeking to regulate digital asset trading.',
                'body' => '<p>Greece is reportedly planning to introduce a 15% capital gains tax on cryptocurrency transactions, joining a growing list of countries seeking to regulate digital asset trading. The proposed tax rate is relatively moderate compared to other European nations.</p><p>The move is part of a broader effort by the Greek government to establish a clear regulatory framework for digital assets while generating additional revenue from the growing crypto economy.</p>',
                'featured_image' => 'assets/uploads/20260609-160219-f013e497.jpg',
                'category_id' => $cryptocurrency->id,
                'author_name' => 'NewsRealm',
                'published_at' => '2026-06-09 15:00:00',
                'is_trending' => false,
                'is_editor_pick' => true,
            ],

            [
                'title' => 'US actor James Handy stabbed to death, with girlfriend\'s son arrested',
                'slug' => 'us-actor-james-handy-stabbed-to-death-with-girlfriend-s-son-arrested',
                'excerpt' => 'US actor James Handy was tragically stabbed to death, and authorities have arrested his girlfriend\'s son in connection with the incident.',
                'body' => '<p>US actor James Handy was tragically stabbed to death, and authorities have arrested his girlfriend\'s son in connection with the incident. The entertainment community has been left in shock following the news of the actor\'s untimely death.</p><p>Handy was known for his work in film and television, and tributes have been pouring in from colleagues and fans alike. The investigation into the circumstances surrounding his death is ongoing.</p>',
                'featured_image' => 'assets/uploads/20260612-173055-b5ee28a7.jpg',
                'category_id' => $entertainment->id,
                'author_name' => 'NewsRealm',
                'published_at' => '2026-06-12 16:00:00',
                'is_trending' => false,
                'is_editor_pick' => true,
            ],

            [
                'title' => 'Boy George receives lifetime achievement honour at LGBT Awards',
                'slug' => 'boy-george-receives-lifetime-achievement-honour-at-lgbt-awards',
                'excerpt' => 'Boy George was honored with a lifetime achievement award at this year\'s LGBT Awards, recognizing his decades-long contribution to music and LGBTQ+ advocacy.',
                'body' => '<p>Boy George was honored with a lifetime achievement award at this year\'s LGBT Awards, recognizing his decades-long contribution to music and LGBTQ+ advocacy. The Culture Club frontman received a standing ovation as he accepted the award.</p><p>In his acceptance speech, Boy George reflected on his journey in the music industry and the importance of LGBTQ+ representation in the arts.</p>',
                'featured_image' => 'assets/uploads/20260612-172424-44b38d45.jpg',
                'category_id' => $entertainment->id,
                'author_name' => 'NewsRealm',
                'published_at' => '2026-05-28 12:00:00',
                'is_trending' => false,
                'is_editor_pick' => true,
            ],

            [
                'title' => 'Lupita Nyong\'o rejects criticism of Helen of Troy role',
                'slug' => 'lupita-nyong-o-rejects-criticism-of-helen-of-troy-role',
                'excerpt' => 'Lupita Nyong\'o has pushed back against criticism of her casting as Helen of Troy, defending the importance of diverse representation in historical storytelling.',
                'body' => '<p>Lupita Nyong\'o has pushed back against criticism of her casting as Helen of Troy, defending the importance of diverse representation in historical storytelling. The Oscar-winning actress addressed the controversy in a recent interview, emphasizing that historically inspired narratives should reflect the diversity of the modern world.</p><p>Nyong\'o\'s remarks have sparked a broader conversation about representation in period pieces and the need for more inclusive casting practices in Hollywood.</p>',
                'featured_image' => 'assets/uploads/20260611-080953-ea0dc60d.jpg',
                'category_id' => $entertainment->id,
                'author_name' => 'NewsRealm',
                'published_at' => '2026-05-22 09:00:00',
                'is_trending' => false,
                'is_editor_pick' => true,
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
