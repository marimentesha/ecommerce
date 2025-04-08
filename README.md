# ecommerce website

## Home Page
- **Category Navigation**: Browse products by category.
- **Popular Products**: Horizontally scrollable section showcasing trending items.
- **New Items**: Newly added products displayed in a separate slider.
- **Sale**: Discounted products presented in an easy-to-browse format.
- **Coupon Form**: Apply a coupon code directly from the homepage to update the cart total.
- **About Us Preview**: A short introduction with a **Read More** link leading to the full About Us page.

## About Us Page
- **Overview**: Detailed information about the company, values, and mission.
- **Main Image**: A large photo representing the brand.
- **Gallery**: A collection of smaller photos at the bottom of the page.

## Contacts Page
- **Social Media**: Handles of Instagram and Twitter profiles.
- **Contact Information**: Phone number and email address for customer support or inquiries.
- **Instagram Photos**: Visual content from the brand’s Instagram feed.

## Feedback Page
- **Feedback Form**: Users can submit their name, email, and feedback or suggestions to help improve the website and services.

## Login Page
- **Login Form**: Email and password fields for user authentication.

## Register Page
- **Registration Form**: First name, last name, email, phone number, password, and repeat password fields for new user sign-up.

## Account Page
Divided into five sections:
- **Profile Info**: Edit name, phone number, and email.
- **Orders**: Shows all orders with status filter tabs (All, Pending, Delivered, Canceled) and "Full Order" buttons to view order details.
- **Addresses**: Edit address, country, city, zip code, and phone number.
- **Credit Cards**: List of saved cards (last 4 digits shown), with an option to change them.
- **Change Password**: Form with current password, new password, and repeat new password fields.

## Search Functionality
- **Search Results**: Displays matching products with main photo, name, price, add to cart and wishlist buttons.
- **No Results**: Shows a message and a button to go to the catalog if no products match the search term.

## Catalog Page
- **Product Listing**: All products are displayed with relevant info.
- **Category Filter**: Dropdown to filter products by category.
- **Sort Options**: Dropdown to sort products by ascending or descending order.

## Product Page
- **Product Details**: Main image, additional photos, name, description, quantity selector, price.
- **Actions**: Add to cart and add to wishlist buttons.
- **Reviews**: Scrollable section with user reviews. User's own reviews have edit and delete buttons.
- **Review Form**: Form for leaving or editing a review.
- **"You May Also Like"**: Scrollbar showing similar product suggestions.

### Cart Page
- **Product List**: Displays added products with quantity controls and remove options.
- **Wishlist Option**: Ability to add products from cart to wishlist.
- **Checkout Button**: Takes the user to the checkout process.
- **"You May Also Like"**: Displays similar or related products.
- **Empty State**: If no items are added, shows a message and a button to go to the catalog page.

## Multi-Step Checkout Page
The user is guided through three steps to complete their order: Contact Information, Delivery & Payment, and Order Confirmation.

### Cart Preview
- Visible on all steps
- Lists product names, quantities, and prices
- Includes a link to edit the order

### Step 1: Contact Information
- Input fields for:
  - First Name
  - Last Name
  - Phone Number
- Payment selection:
  - Cash with courier
  - Card

### Step 2: Delivery & Payment
- Card Details (enabled if card chosen in payment selection):
  - Card Number
  - Expiry Year & Month
  - Card Type
  - CVV
- Delivery Address:
  - Country
  - City
  - Address (Line 1 & Line 2)
  - Zip Code

### Step 3: Order Confirmation
- Displays a summary of:
  - Name and contact
  - Full delivery address
  - Selected payment method and card preview (if applicable)
  - Cart items and total price
- Options to go back or confirm the order

## Wishlist Page
- **Product Scrollbar**: Shows wishlist items with delete and add to cart buttons.
- **"You May Also Like"**: Scrollbar of similar recommended products.
- **Empty State**: Displays a message and a button to go to the catalog when the wishlist is empty.

# Admin Panel
Accessible via /admin. 
Certain sections are restricted based on user roles:
- **Admins**: Full access to all pages.
- **Sellers**: Limited access to only their own content in applicable sections.
- **buyers**: no access to the admin panel.

## Categories (Admins Only)
- **List View**: Displays all categories with Edit and Delete buttons.
- **Edit Page**: Form with fields to change category photo, name, and select a parent category.
- **Add Page**: Form with fields to upload a photo, enter category name, and select a parent category.

## Coupons (Admins Only)
- **List View**: Displays all coupons with Edit and Delete buttons.
- **Edit Page**: Form with fields for coupon code, discount type, discount value, and expiration date.
- **Add Page**: Form with the same inputs as the edit page for creating a new coupon.

## Orders (Admins & Sellers)
- **List View**: 
  - Admins see all orders with Edit and Delete buttons.
  - Sellers see only their orders with Edit/Delete options.
- **Edit Page**: Form to update customer name, order status, and payment status.
- **Product Management**: Shows products in the order with a link to a page where quantity can be changed and items can be removed.

## Products (Admins & Sellers)
- **List View**:
  - Admins see all products with Edit, Delete, and Add/Delete Images buttons.
  - Sellers see only their own products with the same controls.
- **Edit Page**: Form to update main photo, name, description, price, stock, and select a category.
- **Add/Delete Images Page**: Scrollbar of additional product images with delete buttons and an add-more-photos form.
- **Create Product**: Form with fields to add photo, name, description, price, stock, and select a category.

## Reviews (Admins & Sellers)
- **List View**:
  - Admins see all reviews with Edit and Delete buttons.
  - Sellers see only their own products' reviews with the same controls.
- **Edit Page**: Form with star rating and review text fields.

## Roles (Admins Only)
- **List View**: Displays all roles with Edit and Delete buttons.
- **Edit Page**: Form to change role name.
- **Add Page**: Form to create a new role with a role name field.

## Users (Admins & Sellers)
- **List View**:
  - Admins see all users with Edit and Delete buttons.
  - Sellers see only their own user profile.
- **Edit Page**: Form to assign or change the user’s role.
