/* global localStorage */
import setChecklistItemStatus from './common/setChecklistItemStatus';
import getChecklistItemStatus from './common/getChecklistItemStatus';
import expandCollapseList from './common/expandCollapseList';
import copyChecklistUrl from './common/copyChecklistUrl';

import './scss/frontend.scss';

// Let's get list of checklists from local storage DB
const quChecklistsDBName = 'quChecklists';
const quChecklistsDB = localStorage.getItem( quChecklistsDBName );

// Get all label elements in checklists on page
const checkListLabels = document.querySelectorAll(
	'.qu-ChecklistItem label, .qu-ChecklistItem .label'
);

if ( quChecklistsDB && checkListLabels ) {
	// Parse the local storage string to JSON
	const quChecklistsData = JSON.parse( quChecklistsDB );

	// Saving all needed data to one variable name
	const properties = {
		quChecklistsDBName,
		quChecklistsData,
		checkListLabels,
	};

	/* -------- SETS THE CHECKED AND OPEN STATUS OF CHECKLIST ITEM -------*/
	setChecklistItemStatus( properties );

	/* -------- READING THE DATA AND SETTING THE CHECKLISTS --------*/
	getChecklistItemStatus( properties );

	/* -------- OPENS OR CLOSES ALL CHECKLIST ITEMS FOR GIVEN CHECKLIST --------*/
	expandCollapseList( properties );

	/* -------- COPY BUTTON TO COPY URL OF CHECKLIST TO CLIPBOARD --------*/
	copyChecklistUrl();
}
