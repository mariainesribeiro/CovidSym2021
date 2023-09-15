# Welcome to CovidSym Repository
Web Medical Decision Support system for COVID-19 test prescription, leveraging a decision tree classifier trained on binary and non-binary symptom data collected from Kaggle.

## Context
The COVID-19 pandemic that we are experiencing today is characterized by being easily contagious and difficult to diagnose as it presents symptoms identical to those of a common flu or cold. Since testing is the most common diagnostic technique reliable, and that the country has a limited testing capacity, it is important to have testing systems diagnostic support that assesses the risk of being in the presence of a patient with COVID-19 and triage cases that are less likely to prioritize
to testing cases with the highest risk.

## Goal
The CovidSym system that was developed consists of a registration and symptom analysis, which supports the doctor in assessing the user's risk of being
diagnosed with COVID-19. 

## Scope 
In CovidSym, the risk assessment is carried out automatically based on the registered indicators, using a Medical Decision Support (MDS) System implemented using decision trees. The basis of the system is the symptom record of the Patient, that is, there is a personal file in the clinical/hospital unit that has the Patient's administrative data and which in turn also has associated a set of symptoms, based on which the MDS system will carry out the classification.

To create the MDS system, a public database (source: kaggle) was used, which contains information on 127 cases and whose result is a risk assessment at 3 levels.
The CovidSym system is based on a web interface and has access differentiated for Doctors, Administrators, Researchers (data analysts) and for the Patient. The Patient has full access to all their data. The Doctor has access to the entire information about its patients and can record the patient consultation by producing a diagnosis (risk assessment). The researcher has access to all data except the name (and any other identifier that exists, e.g. address, citizen card, etc.). Patients must only enter their administrative data, with their clinical record being subsequently completed by the doctor. Administrators are able to create/disable users tokens

## Contents
### CodeSym
Includes files developed for the system. Languages employed: php, html, css, javascript.

### ImagesSym
Includes scrennshots of the final web system
