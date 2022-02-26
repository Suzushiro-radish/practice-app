import React from 'react';
import MainMenuItem from '@/Layouts/MainMenuItem';

export default () => {
  return (
    <div className="flex-row" >
      <MainMenuItem text="Dashboard" link="dashboard" />
      <MainMenuItem text="Instruments" link="instruments" />
      <MainMenuItem text="Mypage" link="bookmarks" />
    </div>
  );
};