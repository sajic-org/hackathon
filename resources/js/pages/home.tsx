import Layout from '@/layouts/layout';
import { Head } from '@inertiajs/react';

export default function Home() {
    return (
        <Layout>
            <Head title="Home" />
            <div className="flex items-center justify-center p-4">
                {/* Home page content goes here */}
            </div>
        </Layout>
    );
}
