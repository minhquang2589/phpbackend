import React, { useState, useEffect } from 'react';
import axios from 'axios';

// function ProductList() {
//     const [products, setProducts] = useState([]); 
//     const apiUrl = 'http://localhost:3000/apireact/reactapi.php';

function RegisterForm() {
    const [fullname, setFullname] = useState('');
    const [email, setEmail] = useState('');
    const [phone, setPhone] = useState('');
    const [birthday, setBirthday] = useState('');
    const [gender, setGender] = useState('');
    const [password, setPassword] = useState('');
    const [confirmPassword, setConfirmPassword] = useState('');
    const [address, setAddress] = useState('');
    const [errorMessage, setErrorMessage] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const response = await axios.post('http://127.0.0.1:8000/register', {
                fullname: fullname,
                email: email,
                phone: phone,
                birthday: birthday,
                gender: gender,
                password: password,
                address: address
            });
            console.log(response);
        } catch (error) {
            console.error(error);
        }
    };

    return (
        <div className="lg:flex">
            <div className="lg:w-1/2 xl:max-w-screen-sm">
                <div className="sm:px-24 mt-0 md:px-48 pt-10 lg:px-12 lg:mt-6 xl:px-24">
                    <h2 className="text-center flex justify-center text-4xl font-display font-semibold xl:text-4xl xl:text-bold">Register</h2>
                    <div className="mt-12">
                        <form onSubmit={handleSubmit}>
                            <div className="bg-white shadow-md rounded px-8 pt-6 pb-8 flex flex-col my-2">
                                <div className="-mx-3 ">
                                    <div className="md:w-full px-3">
                                        <label className="block text-sm font-bold tracking-wide text-gray-700 mb-2" htmlFor="fullname">Full Name</label>
                                        <input className="text-sm appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4 mb-2" id="fullname" name="fullname" type="text" placeholder="Enter Your Name" value={fullname} onChange={(e) => setFullname(e.target.value)} />
                                    </div>
                                    <div className="md:w-full px-3">
                                        <label className="block text-sm font-bold tracking-wider text-gray-700 mb-2" htmlFor="email">Email Address</label>
                                        <input className="appearance-none text-sm block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4 mb-3" id="email" name="email" type="text" placeholder="Enter Your Email" value={email} onChange={(e) => setEmail(e.target.value)} />
                                    </div>
                                    <div className="md:w-full px-3">
                                        <label className="block text-sm font-bold tracking-wide text-gray-700 mb-2" htmlFor="phone">Phone Number</label>
                                        <input className="appearance-none block w-full bg-grey-lighter text-sm text-grey-darker border border-grey-lighter rounded py-2 px-4 mb-3" id="phone" name="phone" type="text" placeholder="Enter Your Phone Number" value={phone} onChange={(e) => setPhone(e.target.value)} />
                                    </div>
                                </div>
                                <div className="flex justify-between">
                                    <div>
                                        <div className="">
                                            <label className="block text-sm font-bold tracking-wide text-gray-700 mb-2" htmlFor="birthday">Birthday</label>
                                            <input className="appearance-none block w-full bg-grey-lighter text-sm text-grey-darker border border-grey-lighter rounded py-2 px-6 sm:px-8 lg:px-8 mb-3" id="birthday" name="birthday" type="date" placeholder="Enter Your Phone Number" value={birthday} onChange={(e) => setBirthday(e.target.value)} />
                                        </div>
                                    </div>
                                    <div>
                                        <div className="w-full mr-5">
                                            <label className="block text-sm font-bold tracking-wide text-gray-700 mb-2" htmlFor="gender">Gender</label>
                                            <div className="">
                                                <select id="gender" name="gender" className="block w-full px-4 sm:px-5 lg:px-5 pt-2 pb-3 text-sm text-grey-darker border border-grey-lighter rounded focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value={gender} onChange={(e) => setGender(e.target.value)}>
                                                    <option hidden disabled>Choose a gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="inline-table">
                                    <div className="-mx-3 mb-3">
                                        <div className="md:w-full px-3">
                                            <label className="tracking-wide text-gray-700 text-sm font-bold mb-2" htmlFor="password">Password</label>
                                            <input className="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4" id="password" name="password" type="password" placeholder="*********" value={password} onChange={(e) => setPassword(e.target.value)} />
                                        </div>
                                    </div>
                                    <div className="-mx-3 md:flex mb-6">
                                        <div className="md:w-full px-3">
                                            <label className="tracking-wide text-gray-700 text-sm font-bold mb-2" htmlFor="confirm_password">Confirm Password</label>
                                            <input className="appearance-none block w-full bg-grey-lighter text-gray-700 border border-grey-lighter rounded py-2 px-4 mb-3" id="confirm_password" name="confirm_password" type="password" placeholder="*********" value={confirmPassword} onChange={(e) => setConfirmPassword(e.target.value)} />
                                            <p className="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p>
                                        </div>
                                    </div>
                                </div>
                                <div className="-mx-3 md:flex mb-2">
                                    <div className="md:w-full px-3 mb-6 md:mb-0">
                                        <label className="block tracking-wide text-gray-700 text-sm font-bold mb-2" htmlFor="address">Address</label>
                                        <input className="appearance-none text-sm block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4" id="address" name="address" type="text" placeholder="Enter Your Address" value={address} onChange={(e) => setAddress(e.target.value)} />
                                    </div>
                                </div>
                                <div className="mt-10">
                                    <button className="bg-gray-700 text-gray-100 p-4 w-full rounded-full tracking-wide font-semibold font-display focus:outline-none focus:shadow-outline hover:bg-gray-800 shadow-lg" type="submit">Register</button>
                                </div>
                                <div className="mt-12 text-sm font-display font-semibold text-gray-700 text-center">
                                    You have account? <a href="/login" className="cursor-pointer text-red-600 hover:text-red-800">Sign in</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div className="hidden w-full h-2/5 lg:flex items-center justify-center flex-1">
                <div className="z-1 transform duration-200 hover:scale-110 cursor-pointer">
                    <img className="w-full mx-auto" id="f080dbb7-9b2b-439b-a118-60b91c514f72" data-name="Layer 1" viewBox="0 0 528.71721 699.76785" src="https://tailwindcss.com/_next/static/media/installation.50c59fdd.jpg" alt="image" />
                </div>
            </div>
        </div>
    );
}

export default RegisterForm;
