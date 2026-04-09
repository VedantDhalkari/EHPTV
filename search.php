<?php
session_start();

if(isset($_SESSION['locked']) && $_SESSION['locked'] == true){
    header("Location: ransom_locker.php");
    exit();
}

$search=$_POST['search'];
if ($search) {
    echo $search;
    echo '<script>
         window.location.href="index.php";
         </script>';
    exit();
}

// $search_query = isset($_GET['query']) ? $_GET['query'] : '';
$search_query = isset($_GET['query']) ? htmlspecialchars($_GET['query'], ENT_QUOTES, 'UTF-8') : '';
$results = [];

// Simple search functionality - no security, just basic search
// if ($search_query) {
//     // Simulate search results
//     $all_content = [
//         'Personal Banking' => 'Open a personal account with EcoBank and enjoy green banking benefits',
//         'Business Banking' => 'Sustainable business solutions for environmentally conscious companies',
//         'Green Loans' => 'Special loans for eco-friendly projects and renewable energy initiatives',
//         'Carbon Neutral' => 'Learn about our carbon neutral banking initiatives',
//         'Investment Options' => 'Sustainable investment opportunities that protect the planet',
//         'Digital Banking' => 'Paperless banking solutions for the modern world',
//         'Eco Rewards' => 'Earn rewards for sustainable banking practices',
//         'Security' => 'Advanced security measures to protect your financial data',
//         'Mobile App' => 'Bank on the go with our eco-friendly mobile application',
//         'Sustainability Reports' => 'Annual reports on our environmental impact'
//     ];
    
//     foreach ($all_content as $title => $description) {
//         if (stripos($title, $search_query) !== false || stripos($description, $search_query) !== false) {
//             $results[] = ['title' => $title, 'description' => $description];
//         }
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - EcoBank</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #2c3e50;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }
        
        .logo {
            display: flex;
            align-items: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: #27ae60;
        }
        
        .logo::before {
            content: "🌿";
            margin-right: 10px;
            font-size: 2rem;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }
        
        .search-bar {
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(39, 174, 96, 0.05));
            border: 2px solid rgba(39, 174, 96, 0.2);
            border-radius: 30px;
            padding: 0.7rem 1.2rem;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .search-bar::before {
            content: "🌿";
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            color: #27ae60;
            z-index: 1;
        }
        
        .search-bar:focus-within {
            background: linear-gradient(135deg, rgba(255, 255, 255, 1), rgba(39, 174, 96, 0.08));
            border-color: #27ae60;
            box-shadow: 0 6px 25px rgba(39, 174, 96, 0.2);
            transform: translateY(-2px);
        }
        
        .search-bar input {
            background: none;
            border: none;
            color: #2c3e50;
            outline: none;
            width: 220px;
            font-size: 0.95rem;
            padding-left: 30px;
            font-weight: 500;
        }
        
        .search-bar input::placeholder {
            color: #7f8c8d;
            font-style: italic;
        }
        
        .search-bar button {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            border: none;
            color: white;
            cursor: pointer;
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(39, 174, 96, 0.3);
            margin-left: 0.5rem;
        }
        
        .search-bar button:hover {
            background: linear-gradient(135deg, #229954 0%, #27ae60 100%);
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(39, 174, 96, 0.4);
        }
        
        .nav-links a {
            text-decoration: none;
            color: #2c3e50;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: #27ae60;
        }
        
        main {
            padding: 3rem 0;
        }
        
        .search-header {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .search-header h1 {
            color: #27ae60;
            margin-bottom: 1rem;
            font-size: 2.5rem;
        }
        
        .search-query {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border-left: 4px solid #27ae60;
        }
        
        .results-section {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .result-item {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid #27ae60;
        }
        
        .result-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .result-item h3 {
            color: #27ae60;
            margin-bottom: 0.5rem;
        }
        
        .result-item p {
            color: #555;
            margin-bottom: 0.5rem;
        }
        
        .no-results {
            text-align: center;
            padding: 3rem;
            color: #7f8c8d;
        }
        
        .no-results h2 {
            margin-bottom: 1rem;
            color: #95a5a6;
        }
        
        .back-btn {
            display: inline-block;
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
            margin-top: 2rem;
        }
        
        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
        }
    </style>
</head>
<body>
    <header>
        <nav class="container">
            <div class="logo">EcoBank</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li>
                    <form class="search-bar" method="GET" action="search.php">
                        <input type="text" name="query" placeholder="Search for eco-friendly banking solutions..." value="<?php echo $search_query; ?>" required>
                        <button type="submit">Search</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <section class="search-header">
            <h1>🔍 Search Results</h1>
            <?php if ($search_query): ?>
                <div class="search-query">
                    <strong>Searching for:</strong> "<?php echo $search_query; ?>"
                </div>
                <p>Found <?php echo count($results); ?> result(s)</p>
            <?php endif; ?>
        </section>

        <section class="results-section">
            <?php if ($search_query && !empty($results)): ?>
                <?php foreach ($results as $result): ?>
                    <div class="result-item">
                        <h3><?php echo $result['title']; ?></h3>
                        <p><?php echo $result['description']; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php elseif ($search_query): ?>
                <div class="no-results">
                    <h2>🔍 No Results Found</h2>
                    <p>We couldn't find any results for "<?php echo $search_query; ?>"</p>
                    <p>Try searching for: Personal Banking, Green Loans, Carbon Neutral, or Security</p>
                </div>
            <?php else: ?>
                <div class="no-results">
                    <h2>🔍 Search EcoBank</h2>
                    <p>Enter a search term to find information about our services</p>
                </div>
            <?php endif; ?>
            
            <a href="index.php" class="back-btn">🏠 Return to Home</a>
        </section>
    </main>
</body>
</html>
