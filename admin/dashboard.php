<?php
include('../config/db.php');

$result = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Admin Dashboard | Feedback Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom styles for better mobile touch targets */
        @media (max-width: 640px) {
            button, 
            .clickable {
                min-height: 44px;
                min-width: 44px;
            }
            textarea {
                font-size: 16px !important; /* Prevents zoom on iOS */
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">

    <!-- Header with gradient background - Mobile optimized -->
    <div class="bg-gradient-to-r from-orange-500 to-orange-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="bg-white/20 p-2 sm:p-3 rounded-lg backdrop-blur-sm">
                        <i class="fas fa-comments text-white text-xl sm:text-2xl lg:text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white tracking-tight">
                            Feedback Dashboard
                        </h1>
                        <p class="text-orange-100 text-xs sm:text-sm mt-0.5 sm:mt-1">
                            Manage and respond to customer feedback
                        </p>
                    </div>
                </div>
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="bg-white/20 backdrop-blur-sm px-3 sm:px-4 py-2 rounded-lg flex items-center space-x-2">
                        <i class="fas fa-envelope text-white text-sm"></i>
                        <span class="text-white font-semibold text-sm sm:text-base">
                            <?= $result->num_rows ?> 
                            <span class="hidden xs:inline">Total</span>
                        </span>
                    </div>
                    <button onclick="window.location.reload()" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm p-2 rounded-lg transition-all duration-200">
                        <i class="fas fa-sync-alt text-white text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content - Fully Responsive -->
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6 lg:py-8">

        <?php if($result->num_rows > 0): ?>
            <!-- Responsive Grid: 1 column on mobile, 2 on tablet, 3 on desktop -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-3 sm:gap-4 lg:gap-6">

            <?php while($row = $result->fetch_assoc()) { ?>

                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-orange-200 group">
                    
                    <!-- Card Header with rating-based color -->
                    <div class="h-1.5 sm:h-2 bg-gradient-to-r 
                        <?php 
                        $rating = intval($row['rating']);
                        if($rating >= 4) echo 'from-green-400 to-green-500';
                        elseif($rating >= 3) echo 'from-yellow-400 to-yellow-500';
                        else echo 'from-red-400 to-red-500';
                        ?>">
                    </div>
                    
                    <div class="p-4 sm:p-5 lg:p-6">
                        <!-- User Info Section - Responsive -->
                        <div class="flex flex-col xs:flex-row xs:items-start justify-between gap-3 mb-3 sm:mb-4">
                            <div class="flex items-center space-x-2 sm:space-x-3">
                                <div class="bg-gradient-to-br from-orange-100 to-orange-200 p-2 sm:p-2.5 lg:p-3 rounded-full flex-shrink-0">
                                    <i class="fas fa-user-circle text-xl sm:text-2xl text-orange-600"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h3 class="font-bold text-gray-800 text-sm sm:text-base lg:text-lg truncate"><?= htmlspecialchars($row['name']) ?></h3>
                                    <a href="mailto:<?= htmlspecialchars($row['email']) ?>" class="text-xs sm:text-sm text-gray-500 hover:text-orange-600 transition-colors block truncate">
                                        <i class="fas fa-envelope mr-1 text-xs"></i>
                                        <?= htmlspecialchars($row['email']) ?>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Rating Badge - Responsive -->
                            <div class="flex items-center bg-yellow-50 px-2 sm:px-3 py-1.5 sm:py-2 rounded-full self-start xs:self-center">
                                <span class="text-yellow-400 mr-1 text-sm sm:text-base">★</span>
                                <span class="font-semibold text-gray-700 text-sm sm:text-base"><?= $row['rating'] ?>.0</span>
                            </div>
                        </div>

                        <!-- Message Section - Responsive -->
                        <div class="bg-gray-50 rounded-lg p-3 sm:p-4 mb-3 sm:mb-4 border-l-4 border-orange-400">
                            <p class="text-xs uppercase tracking-wider text-gray-500 mb-1.5 sm:mb-2">
                                <i class="fas fa-quote-left mr-1 text-orange-400 text-xs"></i>
                                Customer Message
                            </p>
                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed break-words"><?= nl2br(htmlspecialchars($row['message'])) ?></p>
                        </div>

                        <!-- Timestamp - Responsive -->
                        <div class="flex flex-wrap items-center gap-2 text-xs text-gray-400 mb-3 sm:mb-4">
                            <span class="flex items-center">
                                <i class="far fa-clock mr-1"></i>
                                <span><?= date('M j, Y', strtotime($row['created_at'])) ?></span>
                            </span>
                            <span class="hidden xs:inline">•</span>
                            <span class="flex items-center">
                                <i class="far fa-calendar-alt mr-1"></i>
                                <span><?= date('g:i a', strtotime($row['created_at'])) ?></span>
                            </span>
                        </div>

                        <!-- Response Form Section - Mobile Optimized -->
                        <div class="border-t border-gray-100 pt-3 sm:pt-4">
                            <p class="text-xs sm:text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-reply mr-2 text-orange-500"></i>
                                Your Response
                                <?php if(!empty($row['response'])): ?>
                                    <span class="ml-2 text-xs text-green-600 flex items-center">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Saved
                                    </span>
                                <?php endif; ?>
                            </p>
                            
                            <form action="reply.php" method="POST">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                                <div class="relative">
                                    <textarea name="response" 
                                        placeholder="Type your response..."
                                        class="w-full p-3 sm:p-4 border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition-all resize-vertical text-sm sm:text-base min-h-[80px] sm:min-h-[100px]"
                                        <?php echo !empty($row['response']) ? 'class="border-green-200 bg-green-50/30"' : ''; ?>><?= htmlspecialchars($row['response'] ?? '') ?></textarea>
                                    
                                    <!-- Character count for mobile -->
                                    <div class="absolute bottom-2 right-3 text-xs text-gray-400 bg-white/80 px-2 py-1 rounded-full">
                                        <i class="far fa-keyboard mr-1"></i>
                                        <span class="hidden xs:inline">Type here</span>
                                    </div>
                                </div>

                                <!-- Response button - Full width on mobile -->
                                <div class="mt-3 flex flex-col-reverse xs:flex-row xs:items-center xs:justify-between gap-2">
                                    <?php if(!empty($row['response'])): ?>
                                        <span class="text-xs text-gray-500 flex items-center justify-center xs:justify-start">
                                            <i class="fas fa-history mr-1"></i>
                                            Last updated: <?= date('M j', strtotime($row['created_at'])) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-xs text-gray-400 flex items-center justify-center xs:justify-start">
                                            <i class="far fa-clock mr-1"></i>
                                            No response yet
                                        </span>
                                    <?php endif; ?>

                                    <button type="submit" 
                                        class="w-full xs:w-auto bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-4 sm:px-6 py-3 sm:py-2.5 rounded-lg text-sm sm:text-base font-medium transition-all duration-200 flex items-center justify-center space-x-2 shadow-md hover:shadow-lg active:scale-95">
                                        <i class="fas fa-paper-plane text-xs sm:text-sm"></i>
                                        <span>Save Response</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            <?php } ?>

            </div>

            <!-- Responsive Pagination/Info Bar -->
            <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-white rounded-lg shadow-sm p-3 sm:p-4">
                <p class="text-xs sm:text-sm text-gray-600 text-center sm:text-left">
                    <i class="fas fa-chart-bar mr-2 text-orange-500"></i>
                    Showing <span class="font-semibold"><?= $result->num_rows ?></span> feedback entries
                </p>
                <div class="flex items-center justify-center sm:justify-end space-x-2">
                    <span class="text-xs text-gray-500">Page 1 of 1</span>
                    <div class="flex space-x-1">
                        <button class="p-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed" disabled>
                            <i class="fas fa-chevron-left text-xs"></i>
                        </button>
                        <button class="p-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed" disabled>
                            <i class="fas fa-chevron-right text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <!-- Empty State - Fully Responsive -->
            <div class="bg-white rounded-xl shadow-md p-6 sm:p-8 lg:p-12 text-center max-w-2xl mx-auto">
                <div class="bg-orange-100 w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 rounded-full flex items-center justify-center mx-auto mb-4 sm:mb-6">
                    <i class="fas fa-comment-slash text-2xl sm:text-3xl lg:text-4xl text-orange-500"></i>
                </div>
                <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-700 mb-2">No Feedback Yet</h3>
                <p class="text-sm sm:text-base text-gray-500 mb-4 sm:mb-6 px-4">Customer feedback will appear here once submitted. Share your feedback form with customers to start collecting responses.</p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    <button class="w-full sm:w-auto bg-orange-500 hover:bg-orange-600 text-white px-6 sm:px-8 py-3 sm:py-3 rounded-lg text-sm sm:text-base font-medium transition-all duration-200 flex items-center justify-center space-x-2 shadow-md">
                        <i class="fas fa-plus-circle"></i>
                        <span>Add Feedback Form</span>
                    </button>
                    <button class="w-full sm:w-auto border border-gray-300 hover:border-gray-400 text-gray-700 px-6 sm:px-8 py-3 sm:py-3 rounded-lg text-sm sm:text-base font-medium transition-all duration-200 flex items-center justify-center space-x-2">
                        <i class="fas fa-share-alt"></i>
                        <span>Share Form Link</span>
                    </button>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <!-- Mobile Optimization: Add smooth scrolling -->
    <style>
        * {
            -webkit-tap-highlight-color: transparent;
        }
        
        /* Better touch scrolling */
        .overflow-auto {
            -webkit-overflow-scrolling: touch;
        }
        
        /* Responsive text truncation */
        .truncate-mobile {
            @media (max-width: 640px) {
                max-width: 150px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }

        /* Custom breakpoint for extra small devices */
        @media (min-width: 480px) {
            .xs\:inline {
                display: inline;
            }
            .xs\:flex-row {
                flex-direction: row;
            }
            .xs\:items-center {
                align-items: center;
            }
            .xs\:justify-start {
                justify-content: flex-start;
            }
            .xs\:w-auto {
                width: auto;
            }
        }
    </style>
</body>
</html>