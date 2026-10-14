<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Loads the Zild Cafe menu, blog, reviews, team and shop details taken from the static website.
 * Safe to run more than once (menu, blog and settings are matched by slug/key).
 */
class ZildCafeSeeder extends Seeder
{
    public function run(): void
    {
        $this->users();
        $this->menu();
        $this->content();
    }

    private function users(): void
    {
        if (! app()->environment('local', 'testing')) {
            $this->productionAdmin();

            return;
        }

        // Development-only accounts for trying the site locally.
        $admin = User::updateOrCreate(
            ['email' => 'admin@zildcafe.com'],
            ['name' => 'Zild Admin', 'phone' => '0930 558 4612', 'password' => 'password']
        );
        $admin->forceFill(['role' => 'admin'])->save();

        $customer = User::updateOrCreate(
            ['email' => 'customer@example.com'],
            ['name' => 'Demo Customer', 'phone' => '09171234567', 'password' => 'password']
        );
        $customer->forceFill(['credits' => 500])->save(); // for trying the "Credits" payment method
    }

    private function productionAdmin(): void
    {
        $email = config('zild.admin.email');
        $password = config('zild.admin.password');

        if (! is_string($email) || ! filter_var($email, FILTER_VALIDATE_EMAIL)
            || ! is_string($password) || strlen($password) < 12) {
            throw new \RuntimeException(
                'Non-development seeding requires a valid ZILD_ADMIN_EMAIL and a ZILD_ADMIN_PASSWORD of at least 12 characters.'
            );
        }

        $admin = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => config('zild.admin.name') ?: 'Zild Cafe Administrator',
                'phone' => config('zild.admin.phone'),
                'password' => $password,
            ]
        );
        $admin->forceFill(['role' => 'admin'])->save();

        if ($email !== 'admin@zildcafe.com') {
            $demoAdmin = User::where('email', 'admin@zildcafe.com')->first();
            if ($demoAdmin && $demoAdmin->isAdmin()) {
                $demoAdmin->forceFill(['role' => 'customer', 'password' => Str::random(64)])->save();
                $demoAdmin->tokens()->delete();
            }
        }
    }

    private function menu(): void
    {
        foreach ($this->categories() as $row) {
            Category::updateOrCreate(['slug' => $row['slug']], $row);
        }

        foreach ($this->products() as $row) {
            $sizes = $row['sizes'];
            $row['category_id'] = Category::where('slug', $row['category'])->value('id');
            unset($row['sizes'], $row['category']);

            $product = Product::updateOrCreate(['slug' => $row['slug']], $row);

            foreach ($sizes as $size) {
                $product->sizes()->updateOrCreate(['code' => $size['code']], $size);
            }
        }
    }

    private function content(): void
    {
        foreach ($this->blog() as $row) {
            BlogPost::updateOrCreate(['slug' => $row['slug']], $row);
        }

        if (Review::count() === 0) {
            foreach ($this->reviews() as $row) {
                Review::create($row);
            }
        }

        if (TeamMember::count() === 0) {
            foreach ($this->team() as $row) {
                TeamMember::create($row);
            }
        }

        foreach ($this->settings() as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    private function categories(): array
    {
        return [
            [
                'name' => 'Drinks',
                'slug' => 'drinks',
                'description' => 'Frappes, matcha, espresso and refreshers.',
                'image' => 'images/SHAKE.jpg',
                'sort_order' => 1,
            ],
            [
                'name' => 'Snacks',
                'slug' => 'snacks',
                'description' => 'Burgers, fries, nachos, pasta and more.',
                'image' => 'images/SNACKS.jpg',
                'sort_order' => 2,
            ],
        ];
    }

    private function products(): array
    {
        return [
            [
                'name' => 'Chocolate Frappee',
                'price' => 169,
                'image' => 'images/chocolate frappee.jpg',
                'description' => 'Rich, chocolatey indulgence blended to perfection.',
                'is_featured' => false,
                'sizes' => [
                    [
                        'name' => 'Tall',
                        'code' => 'tall',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 0,
                    ],
                    [
                        'name' => 'Grande',
                        'code' => 'grande',
                        'price_modifier' => 0,
                        'is_default' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Venti',
                        'code' => 'venti',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 2,
                    ],
                ],
                'slug' => 'chocolate-frappee',
                'is_available' => true,
                'category' => 'drinks',
            ],
            [
                'name' => 'Strawberry Matcha',
                'price' => 139,
                'image' => 'images/matcha latte.jpg',
                'description' => 'Creamy matcha green tea layered with sweet strawberry.',
                'is_featured' => false,
                'sizes' => [
                    [
                        'name' => 'Tall',
                        'code' => 'tall',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 0,
                    ],
                    [
                        'name' => 'Grande',
                        'code' => 'grande',
                        'price_modifier' => 0,
                        'is_default' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Venti',
                        'code' => 'venti',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 2,
                    ],
                ],
                'slug' => 'strawberry-matcha',
                'is_available' => true,
                'category' => 'drinks',
            ],
            [
                'name' => 'Refresh Drink',
                'price' => 110,
                'image' => 'images/refresh drink.jpg',
                'description' => 'Cool, fruity, and revitalizing — the perfect thirst quencher.',
                'is_featured' => false,
                'sizes' => [
                    [
                        'name' => 'Tall',
                        'code' => 'tall',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 0,
                    ],
                    [
                        'name' => 'Grande',
                        'code' => 'grande',
                        'price_modifier' => 0,
                        'is_default' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Venti',
                        'code' => 'venti',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 2,
                    ],
                ],
                'slug' => 'refresh-drink',
                'is_available' => true,
                'category' => 'drinks',
            ],
            [
                'name' => 'Caramel Frappee',
                'price' => 189,
                'image' => 'images/stawberry biscoff.jpg',
                'description' => 'Sweet strawberry blended with a buttery cookie twist.',
                'is_featured' => false,
                'sizes' => [
                    [
                        'name' => 'Tall',
                        'code' => 'tall',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 0,
                    ],
                    [
                        'name' => 'Grande',
                        'code' => 'grande',
                        'price_modifier' => 0,
                        'is_default' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Venti',
                        'code' => 'venti',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 2,
                    ],
                ],
                'slug' => 'caramel-frappee',
                'is_available' => true,
                'category' => 'drinks',
            ],
            [
                'name' => 'Strawberry Jam',
                'price' => 179,
                'image' => 'images/strawberry jam.jpg',
                'description' => 'Sweet, tangy strawberry goodness in every sip.',
                'is_featured' => false,
                'sizes' => [
                    [
                        'name' => 'Tall',
                        'code' => 'tall',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 0,
                    ],
                    [
                        'name' => 'Grande',
                        'code' => 'grande',
                        'price_modifier' => 0,
                        'is_default' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Venti',
                        'code' => 'venti',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 2,
                    ],
                ],
                'slug' => 'strawberry-jam',
                'is_available' => true,
                'category' => 'drinks',
            ],
            [
                'name' => 'Iced Espresso',
                'price' => 119,
                'image' => 'images/espresso.jpg',
                'description' => 'Chilled espresso served over ice — bold and refreshing.',
                'is_featured' => false,
                'sizes' => [
                    [
                        'name' => 'Tall',
                        'code' => 'tall',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 0,
                    ],
                    [
                        'name' => 'Grande',
                        'code' => 'grande',
                        'price_modifier' => 0,
                        'is_default' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Venti',
                        'code' => 'venti',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 2,
                    ],
                ],
                'slug' => 'iced-espresso',
                'is_available' => true,
                'category' => 'drinks',
            ],
            [
                'name' => 'Caramel Macchiato',
                'price' => 129,
                'image' => 'images/machiatto.jpg',
                'description' => 'Espresso, steamed milk, vanilla, and caramel drizzle.',
                'is_featured' => true,
                'sizes' => [
                    [
                        'name' => 'Tall',
                        'code' => 'tall',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 0,
                    ],
                    [
                        'name' => 'Grande',
                        'code' => 'grande',
                        'price_modifier' => 0,
                        'is_default' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Venti',
                        'code' => 'venti',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 2,
                    ],
                ],
                'slug' => 'caramel-macchiato',
                'is_available' => true,
                'category' => 'drinks',
            ],
            [
                'name' => 'Blueberry Frappee',
                'price' => 189,
                'image' => 'images/blueberry.jpg',
                'description' => 'Creamy, blended drink with blueberries, ice, and milk.',
                'is_featured' => false,
                'sizes' => [
                    [
                        'name' => 'Tall',
                        'code' => 'tall',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 0,
                    ],
                    [
                        'name' => 'Grande',
                        'code' => 'grande',
                        'price_modifier' => 0,
                        'is_default' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Venti',
                        'code' => 'venti',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 2,
                    ],
                ],
                'slug' => 'blueberry-frappee',
                'is_available' => true,
                'category' => 'drinks',
            ],
            [
                'name' => 'Matcha Latte',
                'price' => 129,
                'image' => 'images/matcha.jpg',
                'description' => 'Smooth, earthy matcha blended with steamed milk.',
                'is_featured' => true,
                'sizes' => [
                    [
                        'name' => 'Tall',
                        'code' => 'tall',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 0,
                    ],
                    [
                        'name' => 'Grande',
                        'code' => 'grande',
                        'price_modifier' => 0,
                        'is_default' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Venti',
                        'code' => 'venti',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 2,
                    ],
                ],
                'slug' => 'matcha-latte',
                'is_available' => true,
                'category' => 'drinks',
            ],
            [
                'name' => 'Java Chip with Coffee Jelly',
                'price' => 189,
                'image' => 'images/coffeejelly.jpg',
                'description' => 'Blended coffee, chocolate chips, and coffee jelly for a rich, chewy treat.',
                'is_featured' => false,
                'sizes' => [
                    [
                        'name' => 'Tall',
                        'code' => 'tall',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 0,
                    ],
                    [
                        'name' => 'Grande',
                        'code' => 'grande',
                        'price_modifier' => 0,
                        'is_default' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Venti',
                        'code' => 'venti',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 2,
                    ],
                ],
                'slug' => 'java-chip-with-coffee-jelly',
                'is_available' => true,
                'category' => 'drinks',
            ],
            [
                'name' => 'Burger',
                'price' => 110,
                'image' => 'images/burger.jpg',
                'description' => 'Juicy patty, fresh veggies, and sauces in a soft bun.',
                'is_featured' => true,
                'sizes' => [
                    [
                        'name' => 'Regular',
                        'code' => 'regular',
                        'price_modifier' => 0,
                        'is_default' => true,
                        'sort_order' => 0,
                    ],
                    [
                        'name' => 'with Cheese',
                        'code' => 'double',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'with Egg and Cheese',
                        'code' => 'triple',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 2,
                    ],
                ],
                'slug' => 'burger',
                'is_available' => true,
                'category' => 'snacks',
            ],
            [
                'name' => 'Hotdog Sandwich',
                'price' => 89,
                'image' => 'images/footlong.jpg',
                'description' => 'Grilled sausage in a bun with toppings like ketchup, mustard, and onions.',
                'is_featured' => false,
                'sizes' => [
                    [
                        'name' => 'Regular',
                        'code' => 'regular',
                        'price_modifier' => 0,
                        'is_default' => true,
                        'sort_order' => 0,
                    ],
                    [
                        'name' => 'Footlong',
                        'code' => 'footlong',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 1,
                    ],
                ],
                'slug' => 'hotdog-sandwich',
                'is_available' => true,
                'category' => 'snacks',
            ],
            [
                'name' => 'Fries',
                'price' => 75,
                'image' => 'images/fries.avif',
                'description' => 'Crispy, golden potato sticks — salty and delicious.',
                'is_featured' => false,
                'sizes' => [
                    [
                        'name' => 'Small',
                        'code' => 'small',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 0,
                    ],
                    [
                        'name' => 'Medium',
                        'code' => 'medium',
                        'price_modifier' => 0,
                        'is_default' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Large',
                        'code' => 'large',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 2,
                    ],
                ],
                'slug' => 'fries',
                'is_available' => true,
                'category' => 'snacks',
            ],
            [
                'name' => 'Nachos',
                'price' => 119,
                'image' => 'images/nachos.jpg',
                'description' => 'Crispy tortilla chips topped with cheese, salsa, and other tasty toppings.',
                'is_featured' => false,
                'sizes' => [
                    [
                        'name' => 'Solo',
                        'code' => 'solo',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 0,
                    ],
                    [
                        'name' => 'Regular',
                        'code' => 'regular',
                        'price_modifier' => 0,
                        'is_default' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Party',
                        'code' => 'party',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 2,
                    ],
                ],
                'slug' => 'nachos',
                'is_available' => true,
                'category' => 'snacks',
            ],
            [
                'name' => 'Tuna Pie',
                'price' => 49,
                'image' => 'images/tuna pie.jpg',
                'description' => 'Crispy crust filled with creamy, savory tuna filling.',
                'is_featured' => false,
                'sizes' => [
                    [
                        'name' => 'Regular',
                        'code' => 'regular',
                        'price_modifier' => 0,
                        'is_default' => true,
                        'sort_order' => 0,
                    ],
                    [
                        'name' => 'Jumbo',
                        'code' => 'jumbo',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 1,
                    ],
                ],
                'slug' => 'tuna-pie',
                'is_available' => true,
                'category' => 'snacks',
            ],
            [
                'name' => 'Chicken Pop',
                'price' => 99,
                'image' => 'images/chicken.jpg',
                'description' => 'Bite-sized, crispy, and juicy fried chicken snacks.',
                'is_featured' => false,
                'sizes' => [
                    [
                        'name' => 'Small',
                        'code' => 'small',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 0,
                    ],
                    [
                        'name' => 'Medium',
                        'code' => 'medium',
                        'price_modifier' => 0,
                        'is_default' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Large',
                        'code' => 'large',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 2,
                    ],
                ],
                'slug' => 'chicken-pop',
                'is_available' => true,
                'category' => 'snacks',
            ],
            [
                'name' => 'Pasta (Carbonara)',
                'price' => 120,
                'image' => 'images/pasta.webp',
                'description' => 'Creamy Italian pasta dish made with eggs, cheese, pancetta, and pepper — rich, savory, and comforting.',
                'is_featured' => true,
                'sizes' => [
                    [
                        'name' => 'Regular',
                        'code' => 'regular',
                        'price_modifier' => 0,
                        'is_default' => true,
                        'sort_order' => 0,
                    ],
                    [
                        'name' => 'Large',
                        'code' => 'large',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Family Size',
                        'code' => 'family',
                        'price_modifier' => 0,
                        'is_default' => false,
                        'sort_order' => 2,
                    ],
                ],
                'slug' => 'pasta-carbonara',
                'is_available' => true,
                'category' => 'snacks',
            ],
        ];
    }

    private function blog(): array
    {
        return [
            [
                'title' => 'The Art of Brewing Coffee',
                'excerpt' => 'Discover the techniques and secrets behind brewing the perfect cup of coffee at home.',
                'image' => 'images/coffeejelly.jpg',
                'content' => '<p>Coffee Jelly is a unique dessert that combines the bold flavors of coffee with a fun, chewy texture. In this post, we\'ll take a closer look at the origins of coffee jelly, the process of making it, and why it’s a favorite treat for coffee lovers.</p><h2>The Making of Coffee</h2><p>Coffee Jelly is made by brewing strong coffee and combining it with agar-agar or gelatin to create a firm, jelly-like texture.</p><h2>Flavored Profile</h2><p>The flavor of coffee jelly is a perfect balance between the bitterness of coffee and the smoothness of cream.</p><h2>Conclusion</h2><p>Coffee Jelly is more than just a fun dessert; it’s an exciting way to enjoy coffee in a new form.</p>',
                'slug' => 'the-art-of-brewing-coffee',
                'is_published' => true,
                'published_at' => '2025-04-14 00:00:00',
            ],
            [
                'title' => 'Coffee and Health',
                'excerpt' => 'Learn about the health benefits of coffee and how it boosts your well-being.',
                'image' => 'images/burger.jpg',
                'content' => '<p>Our signature burger is a hearty and juicy delight stacked high with a perfectly grilled beef patty, fresh lettuce, ripe tomatoes, crispy pickles, and creamy cheese. All tucked between warm, toasted buns and drizzled with our special house sauce, it’s the ultimate comfort food for any craving.</p><h2>Premium Ingredients</h2><p>We use 100% pure beef, farm-fresh veggies, and a secret blend of spices to deliver a rich, satisfying flavor in every bite. No shortcuts, just real goodness.</p><h2>Flavor Explosion</h2><p>Every layer is crafted to balance texture and taste—from the soft bun to the crisp toppings and savory patty. It\'s a burst of flavor you won’t forget.</p><h2>Why You’ll Love It</h2><p>Whether you’re dining in or grabbing on the go, our burger is guaranteed to hit the spot. It’s not just a meal—it’s an experience.</p>',
                'slug' => 'coffee-and-health',
                'is_published' => true,
                'published_at' => '2025-04-14 00:00:00',
            ],
            [
                'title' => 'Sustainable Coffee Practices',
                'excerpt' => 'Explore how we source coffee sustainably and support local farmers.',
                'image' => 'images/strawberry jam.jpg',
                'content' => '<p>Our homemade strawberry jam is a delightful blend of sun-ripened strawberries, gently simmered to bring out their natural sweetness and vibrant flavor. It\'s a classic spread that turns any snack or breakfast into a treat.</p><h2>Fresh and Fruity</h2><p>Made with real strawberries and just the right amount of sugar, this jam captures the juicy, tangy-sweet essence of the fruit in every spoonful.</p><h2>Perfect Pairings</h2><p>Spread it over warm toast, pancakes, waffles, or swirl it into your yogurt and oatmeal. It also makes a fantastic filling for pastries and cakes.</p><h2>Why You\'ll Love It</h2><p>With no artificial flavors or preservatives, our strawberry jam is made with love and care—just like grandma used to make. Sweet, simple, and irresistibly delicious.</p>',
                'slug' => 'sustainable-coffee-practices',
                'is_published' => true,
                'published_at' => '2025-04-14 00:00:00',
            ],
        ];
    }

    private function reviews(): array
    {
        return [
            [
                'customer_name' => 'John Doe',
                'rating' => 4,
                'comment' => 'The coffee is fantastic! I love the rich flavors and the aroma. Highly recommend!',
                'image' => 'images/review1.jpg',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Jane Smith',
                'rating' => 5,
                'comment' => 'Best coffee I\'ve ever had! The quality is unmatched, and the service is excellent.',
                'image' => 'images/review2.jpg',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Emily Johnson',
                'rating' => 3,
                'comment' => 'Good coffee, but I expected a bit more flavor. Still a solid choice!',
                'image' => 'images/review3.jpg',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Michael Brown',
                'rating' => 4,
                'comment' => 'Great atmosphere and even better coffee! A must-visit for coffee lovers.',
                'image' => 'images/review4.jpg',
                'is_approved' => true,
            ],
        ];
    }

    private function team(): array
    {
        return [
            [
                'name' => 'Christian Ver',
                'position' => 'Owner & CEO',
                'photo' => 'images/chris2.jpg',
                'sort_order' => 1,
                'is_active' => true,
                'bio' => 'Christian is the visionary behind Zild Coffee. With a deep passion for coffee and community, he founded the shop to bring people together through high-quality brews and a cozy atmosphere.',
            ],
            [
                'name' => 'Jenifer',
                'position' => 'Wife of CEO',
                'photo' => 'images/jen2.jpg',
                'sort_order' => 2,
                'is_active' => true,
                'bio' => 'Jenifer supports the heart of Zild Coffee, helping with daily operations and ensuring a warm, welcoming atmosphere for everyone.',
            ],
            [
                'name' => 'Maila Bacani',
                'position' => 'Helper',
                'photo' => 'images/maila.jpg',
                'sort_order' => 3,
                'is_active' => true,
                'bio' => 'Maila is the reliable helping hand at Zild Coffee, assisting in daily tasks and making sure everything stays neat and organized.',
            ],
        ];
    }

    private function settings(): array
    {
        return [
            'cafe_name' => 'Zild Cafe',
            'tagline' => 'Coffee that hits the right notes.',
            'about_short' => 'Where every cup tells a story — Zild Coffee, your cozy corner for brews, bites, and beautiful moments.',
            'phone' => '0930 558 4612',
            'email' => 'contact@ZildCafe.com',
            'address' => 'Steady Ready, Sta. Rosa, Concepcion, Tarlac',
            'hours_weekdays' => 'Mon-Fri: 2:00 P.M - 10:00 P.M',
            'hours_weekends' => 'Sat-Sun: 12:00 P.M - 11:00 P.M',
        ];
    }
}
