import React from 'react';
import MainMenu from "@/Layouts/MainMenu";

export default function Layout({ title, children }) {
  return (
    <div className="bg-gray">
      <MainMenu />
      {/* To reset scroll region (https://inertiajs.com/pages#scroll-regions) add `scroll-region="true"` to div below */}
      <div className="w-full px-4 py-8 md:p-12">
        {children}
      </div>
    </div>
  );
}