import {useState, useRef, useEffect} from 'react';

function useHandlePagination() {
  const firstPage = useRef(1);
  let [currentPage, setPage] = useState(1);
  useEffect(() => {
    let currentPage = firstPage.current

    if(currentPage <= 1) {
      currentPage = 1;
    }
  }, [currentPage]);

  return [currentPage, setPage];
}

export default useHandlePagination;
