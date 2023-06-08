import { useEffect, FormEventHandler } from "react";
import React from "react";
import Checkbox from "@/Components/Checkbox";
import GuestLayout from "@/Layouts/GuestLayout";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { Head, Link, useForm } from "@inertiajs/react";
import NavLink from "../../Components/NavLink";

export default function Login({
    status,
    canResetPassword,
}: {
    status?: string;
    canResetPassword: boolean;
}) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: "",
        password: "",
        remember: false,
    });
    const [showPassword, setShowPassword] = React.useState(false);

    useEffect(() => {
        return () => {
            reset("password");
        };
    }, []);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route("login"));
    };

    return (
        <>
            <NavLink showLoginText={true} />
            <GuestLayout>
                <div className="pb-12 justify font-bold text-xl">
                    Sign In to Campaign
                </div>

                <Head title="Log in" />
                {status && (
                    <div className="mb-4 font-medium text-sm text-green-600">
                        {status}
                    </div>
                )}

                <form onSubmit={submit}>
                    <div>
                        <InputLabel htmlFor="email" value="Email" />

                        <TextInput
                            id="email"
                            type="email"
                            name="email"
                            value={data.email}
                            className="mt-1 block w-full"
                            autoComplete="username"
                            isFocused={true}
                            onChange={(e) => setData("email", e.target.value)}
                        />

                        <InputError message={errors.email} className="mt-2" />
                    </div>

                    <div className="mt-4">
                        <InputLabel htmlFor="password" value="Password" />

                        <TextInput
                            id="password"
                            type={showPassword ? "text" : "password"} // Set type to "text" when showPassword is true
                            name="password"
                            value={data.password}
                            className="mt-1 block w-full"
                            autoComplete="current-password"
                            onChange={(e) =>
                                setData("password", e.target.value)
                            }
                        />

                        <InputError
                            message={errors.password}
                            className="mt-2"
                        />
                    </div>

                    <div className="flex items-center justify-between py-6">
                        <div className="flex items-center">
                            <Checkbox
                                className="h-4 w-4 text-blue-400"
                                checked={data.remember}
                                onChange={(e) => {
                                    setData("remember", e.target.checked);
                                    setShowPassword(e.target.checked); // Toggle the showPassword state
                                }}
                            />

                            <label className="ml-2 block text-sm text-gray-900">
                                Remember me
                            </label>
                        </div>

                        <div className="text-sm">
                            {canResetPassword && (
                                <Link
                                    href={route("password.request")}
                                    className="font-medium text-blue-400"
                                >
                                    Forgot your password?
                                </Link>
                            )}
                        </div>
                    </div>

                    <PrimaryButton
                        className="w-full font-bold py-2 px-4  "
                        disabled={processing}
                    >
                        Log in
                    </PrimaryButton>
                </form>
            </GuestLayout>
        </>
    );
}
