import React, { useState, useEffect } from 'react';
import axios from 'axios';

function ProductList() {
    const [products, setProducts] = useState([]); 
    const apiUrl = 'http://127.0.0.1:8000/api/products';

    useEffect(() => {
        fetchProducts();
    }, []);

    const fetchProducts = async () => {
        try {
            const response = await axios.get(apiUrl);
            console.log(response.data[0].products);
            setProducts(response.data[0].products);
        } catch (error) {
            console.error('Error fetching products:', error);
        }
    };

    return (
        
        <div className="grid grid-cols-2 lg:mx-5 lg:grid-cols-4 lg:gap-8">
        {Array.isArray(products) && products.map(product => (
            <div key={product.id} className="h-120 rounded-lg">
                <div className="group rounded-xl relative block overflow-hidden">
                    {product.discount_quantity > 0 && (
                        <button className="absolute end-4 top-4 z-10 p-1">
                            <span className="mr-1 text-red-600 px-1 py-0.5 text-xs font-medium">- {product.discount}%</span>
                        </button>
                    )}
                    <div>
                    <img src={`/Applications/XAMPP/htdocs/myweblaravel/public/images/${product.image}`} alt={product.image} className="primage min-h-full rounded-t-2xl w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72" />
                    </div>
                    <div className="relative p-6">
                        <div className="flex items-baseline lg:items-start">
                            <h3 className="mr-3 flex text-[11px] lg:text-sm font-medium">{product.name}</h3>
                            {product.is_new && (
                                <div className="mr-4">
                                    <span className="rounded-full mr-1 text-white bg-red-600 px-1 py-0.5 lg:px-2 lg:py-1 text-xs"> New </span>
                                </div>
                            )}
                        </div>
                        <div>
                            <a data-product-id={product.id} id={`addToCartBtnView${product.id}`} className="group relative justify-center flex items-center overflow-hidden rounded-full border py-1.5 mt-2 g:mt-3 lg:mx-10 lg:py-3 text-gray-500 focus:outline-none focus:ring active:text-gray-600">
                                <span className="absolute -end-full transition-all lg:group-hover:end-4">
                                    <svg className="size-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </span>
                                <div>
                                    <button className="text-sm font-medium transition-all group-hover:me-4">View Product</button>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        ))}
    </div>
    );
}

export default ProductList;
