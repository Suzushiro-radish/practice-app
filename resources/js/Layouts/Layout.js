import React from 'react';
import MainMenu from "@/Layouts/MainMenu";

export default function Layout({ title, children }) {
  return (
    <div className="bg-white">
      <MainMenu />
      {/* To reset scroll region (https://inertiajs.com/pages#scroll-regions) add `scroll-region="true"` to div below */}
      <div className="w-full">
        {children}
      </div>
    </div>
  );
}