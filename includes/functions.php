<?php
session_start();

function registerUser($email, $password) {
    global $pdo;
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    try {
        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        return $stmt->execute([$email, $hashed_password]);
    } catch(PDOException $e) {
        return false;
    }
}

function loginUser($email, $password) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        return true;
    }
    return false;
}

// NEW FUNCTIONS ADDED
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function formatPrice($price) {
    return '₱' . number_format($price, 2);
}

function getCategories() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT DISTINCT category FROM food_items");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    } catch(PDOException $e) {
        return [];
    }
}

function getFoodItems() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM food_items");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return [];
    }
}

function getFoodItemsByCategory($category) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM food_items WHERE category = ?");
        $stmt->execute([$category]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return [];
    }
}
?>
