@extends('front/layouts.layout')

@push('styles')
    <style>
        .faq-section {
            background-color: #1e1e1e;
            color: #d6cfbd;
            font-family: 'Roboto', sans-serif;
            padding: 2rem 1rem;
        }

        .faq-section h1,
        .faq-section h2 {
            color: #cba34e;
        }

        .faq-section h2 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-size: 1.4rem;
        }

        .faq-section p {
            font-size: 1.5rem;
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .faq-category {
            margin-bottom: 3rem;
        }

        .highlight {
            color: #ffc107;
            font-weight: bold;
        }

        .faq-emoji {
            font-size: 1.5rem;
            margin-right: 0.5rem;
        }
    </style>
@endpush

@section('content')
    <section class="faq-section container">
        <h1 class="fw-bold mb-4 text-uppercase">FAQ: Frequently Annoyed Questions</h1>

        <div class="faq-category">
            <h2>What is Factabot?</h2>
            <p>Factabot gives you the top 30 headlines that actually matter—no filler, no fear-mongering, no clickbait. We read the chaos so you don’t have to open 12 tabs or decode political doublespeak. We sum it up, sass it up, and serve it to you straight.</p>
            <p>Still hungry? Scroll for bonus headlines pulled from trusted local and international sources—curated for the curious, the obsessive, and the terminally caffeinated.</p>
        </div>

        <div class="faq-category">
            <h2>Why Factabot?</h2>
            <p>Because the world vomits thousands of headlines a day—and 99% of them are hot garbage. We cut through the noise to bring you the 30 biggest stories: the ones that move markets, stir drama, or make you go <em>"wait, what?"</em></p>
            <p>Want more? We’ve got deep dives, weird twists, and headlines you didn’t know you needed.</p>
        </div>

        <div class="faq-category">
            <h2>How does Factabot work?</h2>
            <p>AI does the grunt work—scanning global sources (yes, even ones that hate each other) and extracting raw, unfiltered facts. Then comes the Factabot touch: sarcasm, context, contradiction-spotting, and a dash of side-eye. The result? News with brains, bite, and no billionaire filter.</p>
        </div>

        <div class="faq-category">
            <h2>Where and when can I get it?</h2>
            <p><span class="faq-emoji">🗓️</span>Every. Single. Day. We drop 30 fresh, handpicked headlines daily—straight from Australia and around the globe. Whether you’re doomscrolling in bed, commuting to work, or spiraling into existential dread—we’ve got your daily news hit ready.</p>
        </div>

        <div class="faq-category">
            <h2><span class="faq-emoji">💸</span>The Awkward Money Bit</h2>
            <h2>Do I have to pay?</h2>
            <p>Nope. But if you want ad-free bliss and want to support snarky, spin-free news that isn’t bought by billionaires, we’ve got a low-cost subscription. Cheaper than a sad servo sandwich.</p>
        </div>

        <div class="faq-category">
            <h2><span class="faq-emoji">🧭</span>Factabot Values</h2>
            <h2>Is Factabot politically biased?</h2>
            <p>Absolutely not. We roast left, right, and centre with equal enthusiasm. If someone’s lying, spinning, or being a flaming hypocrite, we call it out. No agendas, no allegiances—just facts, sass, and receipts.</p>
        </div>

        <div class="faq-category">
            <h2><span class="faq-emoji">📣</span>Got something to say?</h2>
            <h2>How can I send feedback or suggest a headline?</h2>
            <p>Slide into our DMs, drop us an email, or shout into the void (just kidding—we don’t monitor the void). We actually read every message. If your tip is gold, we might even feature it (and credit you—unless your username is “xXx420BlazeNewsxXx”).</p>
        </div>
    </section>

    {{-- <script>
        let startTime = Date.now();
        window.addEventListener("beforeunload", function () {
            const duration = Math.round((Date.now() - startTime) / 1000);
            const data = {
                url: window.location.pathname,
                duration: duration
            };

            const blob = new Blob([JSON.stringify(data)], { type: 'application/json' });
            navigator.sendBeacon('/track-page-duration', blob);
        });
    </script> --}}
@endsection
