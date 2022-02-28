import React from 'react';
import MainMenuItem from '@/Layouts/MainMenuItem';

export default () => {
  return (
    <div className="flex bg-gray-100" >
      <MainMenuItem text="Dashboard" link="dashboard" />
      <MainMenuItem text="Instruments" link="instruments" />
      <MainMenuItem text="Mypage" link="bookmarks" />
    </div>
  );
};